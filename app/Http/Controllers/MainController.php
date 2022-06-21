<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Project;
use App\Models\Goal;
use App\Models\Task;
use App\Models\Result;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function updateMatrix(Request $requests)
    {
        $list = $requests->input('data');
        foreach (json_decode($list, true) as $key => $value) {
            switch ($value['t']) {
                case 'goal/task':
                    DB::table('goal_task_relations')
                        ->where('goal_id', $value['c'])
                        ->where('task_id', $value['s'])
                        ->update(['value' => $value['v']]);
                    break;
                case 'project/task':
                    DB::table('project_task_relations')
                        ->where('project_id', $value['c'])
                        ->where('task_id', $value['s'])
                        ->update(['value' => $value['v']]);
                    break;
                case 'member/task':
                    DB::table('member_task_relations')
                        ->where('member_id', $value['c'])
                        ->where('task_id', $value['s'])
                        ->update(['value' => $value['v']]);
                    break;
                case 'goal/result':
                    DB::table('goal_result_relations')
                        ->where('goal_id', $value['c'])
                        ->where('result_id', $value['s'])
                        ->update(['value' => $value['v']]);
                    break;
                case 'project/result':
                    DB::table('project_result_relations')
                        ->where('project_id', $value['c'])
                        ->where('result_id', $value['s'])
                        ->update(['value' => $value['v']]);
                    break;

                default:
                    # code...
                    break;
            }
        }
        return $list;
    }
    // Получение страницы модели
    public function getPage($id)
    {
        return view('page', ['id' => $id, 'list' => $this->getList($id)]);
    }
    // Добавление экземпляра модели
    public function addNote(Request $requests)
    {
        $result = false;
        switch ($requests->input('type')) {
            case 'goal':
                $item = new Goal;
                $item->title = $requests->input('title');
                $item->save();
                $result = true;
                break;
            case 'task':
                $item = new Task;
                $item->title = $requests->input('title');
                $item->save();
                $result = true;
                break;
            case 'project':
                $item = new Project;
                $item->title = $requests->input('title');
                $item->save();
                $result = true;
                break;
            case 'member':
                $item = new Member;
                $item->title = $requests->input('title');
                $item->save();
                $result = true;
                break;
            default:
                $item = new Result;
                $item->title = $requests->input('title');
                $item->save();
                $result = true;
                break;
        }
        return true;
    }
    // Получение всех экземпляров модели
    public function getList(String $type)
    {
        switch ($type) {
            case 'goal':
                $model = new Goal;
                $list = $model->all();
                if (!count($list)) return json_encode(['result' => false]);
                break;
            case 'task':
                $model = new Task;
                $list = $model->all();
                if (!count($list)) return json_encode(['result' => false]);
                break;
            case 'project':
                $model = new Project;
                $list = $model->all();
                if (!count($list)) return json_encode(['result' => false]);
                break;
            case 'member':
                $model = new Member;
                $list = $model->all();
                if (!count($list)) return json_encode(['result' => false]);
                break;
            default:
                $model = new Result;
                $list = $model->all();
                if (!count($list)) return json_encode(['result' => false]);
                break;
        }
        return json_encode(['result' => $list]);
    }

    // ОТРИСОВКА ЧАСТЕЙ С НАЗВАНИЯМИ
    function renderMatrixTitles($table_name, $start_string, $start_column, $is_vertical, $is_desc)
    {
        // делать запрос
        // $title_collection = DB::table($table_name)->select('id','title')->get();
        $title_collection = DB::table($table_name)->select('id', 'title')->get();

        $text_table = collect([['id' => '1', 'title' => 'Первый'], ['id' => '2', 'title' => 'Второй']]);
        $text_table2 = collect([]);

        if ($is_desc) {
            // по возрастанию
            $titles = $title_collection->sortByDesc('id');
            $titles = json_decode($titles, true);
        } else {
            // по убыванию
            $titles = $title_collection->sortBy('id');
            $titles = json_decode($titles, true);
            if ($is_vertical) {
                $start_string++;
            }
        }
        $titles = array_values($titles);
        if (!count($titles)) {
            return ['end_string' => $start_string, 'end_column' => $start_column, 'view' => []];
        }
        // готовить из этого массив ячеек таблицы (со старта)
        $view = array();
        $key = 0;
        if ($is_vertical) {
            foreach ($titles as $key => $value) {
                $view[$key + $start_string][$start_column] = '<td class="white">' . $value['title'] . '</td>';
            }
            $end_string = $key + $start_string;
            $end_column = $start_column;
            if ($is_desc) {
                $view[$key + $start_string + 1][$start_column] = '<td class="white title">тактические задачи</td>';
            } else {
                $view[$start_string - 1][$start_column] = '<td class="white title">результаты</td>';
                ksort($view);
            }
        } else {
            foreach ($titles as $key => $value) {
                $view[$start_string][$key + $start_column] = '<td class="white"><div class="wrapper"><div class="rotate">' . $value['title'] . '</div></div></td>';
            }
            $end_string = $start_string;
            $end_column = $key + $start_column;
        }
        // вернуть конечные значения и массив
        return ['end_string' => $end_string, 'end_column' => $end_column, 'view' => $view];
    }

    // ОТРИСОВКА ЧИСЛОВЫХ ЧАСТЕЙ
    function renderMatrixPart(String $rt_name, String $string_name, String $column_name, array $rt_array, Int $start_string = 1, Int $start_column = 1, Bool $counter_string_on_bottom = true, Bool $counter_column_on_right = true)
    {
        $view = array();
        // $rt_array = json_decode($rt_array, true);
        if (!count($rt_array)) {
            return ['end_string' => $start_string, 'end_column' => $start_column, 'view' => []];
        }

        foreach ($rt_array as $key => $value) {
            $row[$key]  = $value[$string_name];
            $column[$key] = $value[$column_name];
        }

        array_multisort($row, SORT_ASC, $column, SORT_ASC, $rt_array);

        $current_string_bd_id = $rt_array[0][$string_name];

        // если подсчёт сверху, увеличить индекс стартовой строки
        if (!$counter_string_on_bottom) {
            $start_string++;
        }
        // если подсчёт слева, увеличить индекс стартового столбца
        if (!$counter_column_on_right) {
            $start_column++;
        }

        $current_string = $start_string;
        $current_column = $start_column;
        // 
        $summ_of_strings = array();
        $summ_of_columns = array();

        foreach ($rt_array as $key => $value) {
            if ($current_string_bd_id != $value[$string_name]) {
                $current_string_bd_id = $value[$string_name];
                // сменить табличный индекс строки 
                $current_string++;
                $current_column = $start_column;
            }

            // $view[$current_string][$current_column] = "<td data-relation='".$rt_name."' data-string='".$value[$string_name]."' data-column='".$value[$column_name]."'>".$value['value']."</td>";
            $view[$current_string][$current_column] = "<td data-relation='" . $rt_name . "' data-string='" . $value[$string_name] . "' data-column='" . $value[$column_name] . "'>" . $value['value'] . "</td>";

            if (isset($summ_of_strings[$current_string])) {
                $summ_of_strings[$current_string] = (int)$summ_of_strings[$current_string] + (int)$value['value'];
            } else {
                $summ_of_strings[$current_string] = $value['value'];
            }
            if (isset($summ_of_columns[$current_column])) {
                $summ_of_columns[$current_column] = (int)$summ_of_columns[$current_column] + (int)$value['value'];
            } else {
                $summ_of_columns[$current_column] = $value['value'];
            }
            $current_column++;
        }
        $end_string = $current_string;
        $end_column = $current_column - 1;


        // если суммы справа->
        // в цикле по строкам добавить ячейки. Добавлять столбец end_column+1
        // если слева ->
        // Добавлять столбец start_column-1
        if ($counter_column_on_right) {
            $end_column++;
            foreach ($view as $key => $value) {
                $view[$key][$end_column] = '<td class="grey">' . $summ_of_strings[$key] . '</td>';
            }
        } else {
            foreach ($view as $key => $value) {
                $view[$key][$start_column - 1] = '<td class="grey">' . $summ_of_strings[$key] . '</td>';
                ksort($view[$key]);
            }
        }

        // вычисление, куда надо добавить пустую ячейку. Если надо, сдвиг остальных строк вправо на 1
        if ($counter_column_on_right) {
            $multiplicator = 0;
            $null_column_index = $end_column;
        } else {
            $multiplicator = 1;
            $null_column_index = 0;
        }

        // если суммы снизу->
        // в цикле по столбцам добавить ячейки. В строке end_string+1
        // Если сверху ->
        // В строке start_string-1
        if ($counter_string_on_bottom) {
            $end_string++;
            foreach ($summ_of_columns as $key => $value) {
                $view[$end_string][$key + $multiplicator] = '<td class="grey">' . $value . '</td>';
            }
            $view[$end_string][$null_column_index] = '<td class="white"></td>';
            ksort($view[$end_string]);
            ksort($view);
        } else {
            foreach ($summ_of_columns as $key => $value) {
                $view[$start_string - 1][$key + $multiplicator] = '<td class="grey">' . $value . '</td>';
            }
            $view[$start_string - 1][$null_column_index] = '<td class="white"></td>';
            ksort($view[$start_string - 1]);
            ksort($view);
        }

        return ['end_string' => $end_string, 'end_column' => $end_column, 'view' => $view];
    }

    // Акутализация и получение данных для матрицы
    function getAndActualizeRelations($table_name_1, $table_name_2, $corresnoding_table_name, $string_name, $column_name)
    {
        $table_1 = DB::table($table_name_1)->select('id')->get();
        $table_2 = DB::table($table_name_2)->select('id')->get();
        $hm = $relations = DB::table($corresnoding_table_name)->select($string_name, $column_name, 'value')->get();

        $unique_strings = $hm1 = $relations->unique($string_name)->pluck($string_name)->all();
        $unique_columns = $hm2 = $relations->unique($column_name)->pluck($column_name)->all();

        // изменить на сортируемый по стобцу 1, столбцу 2
        $unique_models_1 = $table_1->unique('id')->pluck('id')->all();
        $unique_models_2 = $table_2->unique('id')->pluck('id')->all();

        $new_strings = array_diff($unique_models_1, $unique_strings);
        $new_columns = array_diff($unique_models_2, $unique_columns);

        $insert = array();
        // Если экземпляров "строк" в собственной таблице больше, чем в таблицах-отношениях, добавляются ячейки в "строки" существующих столбцов
        if (count($new_strings) && count($unique_columns)) {
            foreach ($new_strings as $value) {
                foreach ($unique_columns as $value2) {
                    // добавление в возвращаемый массив
                    // и к запросу для добавления в БД
                    $relations[] = [$string_name => $value, $column_name => $value2, 'value' => ''];
                    $insert[] = [$string_name => $value, $column_name => $value2, 'value' => ''];
                }
            }
        }
        // Если экземпляров "столбцов" в собственной таблице больше, чем в таблицах-отношениях, добавляются ячейки в "столбцы" существующих строк
        if (count($new_columns) && count($unique_strings)) {
            foreach ($new_columns as $value) {
                foreach ($unique_strings as $value2) {
                    $relations[] = [$string_name => $value2, $column_name => $value, 'value' => ''];
                    $insert[] = [$string_name => $value2, $column_name => $value, 'value' => ''];
                }
            }
        }
        // На случай, если таблица ещё пуста и текущих "строк"/"столбцов" нет, зато есть в основных таблицах
        if (count($new_strings) && count($new_columns) && !count($unique_strings) && !count($unique_columns)) {
            $hm4 = 1;
            foreach ($new_strings as $value) {
                foreach ($new_columns as $value2) {
                    $relations[] = [$string_name => $value, $column_name => $value2, 'value' => ''];
                    $insert[] = [$string_name => $value, $column_name => $value2, 'value' => ''];
                }
            }
        }

        // выполнение запросов-вставок в БД, если есть новые ячейки для таблицы отношений
        if ($insert) {
            DB::table($corresnoding_table_name)->insert($insert);
        }

        if (true) {
            return json_decode(json_encode($relations->toArray()), true);
        }
        return false;
    }

    public function default()
    {
        $data1 = $this->getAndActualizeRelations('goals', 'tasks', 'goal_task_relations', 'goal_id', 'task_id');
        $data2 = $this->getAndActualizeRelations('projects', 'tasks', 'project_task_relations', 'project_id', 'task_id');
        $data3 = $this->getAndActualizeRelations('members', 'tasks', 'member_task_relations', 'member_id', 'task_id');
        $data4 = $this->getAndActualizeRelations('goals', 'results', 'goal_result_relations', 'goal_id', 'result_id');
        $data5 = $this->getAndActualizeRelations('projects', 'results', 'project_result_relations', 'project_id', 'result_id');
        $table = [['string' => 1, 'column' => 1, 'value' => 5], ['string' => 1, 'column' => 2, 'value' => 8], ['string' => 2, 'column' => 1, 'value' => 1], ['string' => 2, 'column' => 2, 'value' => 1]];

        $matrix = array();

        $result = $this->renderMatrixPart('goal/task', 'task_id', 'goal_id', $data1, 2, 1, true, true);
        $matrix_text_1 = $this->renderMatrixTitles('tasks', 2, $result['end_column'] + 1, true, true);
        $result2 = $this->renderMatrixPart('project/task', 'task_id', 'project_id', $data2, 2, $matrix_text_1['end_column'] + 1, true, false);
        $result3 = $this->renderMatrixPart('member/task', 'task_id', 'member_id', $data3, 2, $result2['end_column'] + 1, true, false);

        // Добавление 1-ой строки
        $first_string = ['<td colspan="' . ($result['end_column'] - 1) . '" class="white">взяимосвязи</td>', '<td class="white"></td>', '<td class="white"></td>', '<td class="white"></td>', '<td colspan="' . ($result2['end_column'] - $result['end_column'] - 2) . '" class="white">взаимосвязи/влияние</td>', '<td class="white"></td>', '<td colspan="' . $result3['end_column'] . '" class="white">ответственность</td>'];
        $matrix[1] = $first_string;
        // $matrix_text_1['view'][$matrix_text_1['end_string']+1] = ['<td>4</td>','<td>4</td>','<td>4</td>'];
        foreach ($matrix_text_1['view'] as $key => $value) {
            $matrix[$key] = array();

            $row_list = [0 => $result['view'], 1 => $matrix_text_1['view'], 2 => $result2['view'], 3 => $result3['view']];

            foreach ($row_list as $key2 => $value2) {
                if (isset($value2[$key])) {
                    $matrix[$key] = array_merge($matrix[$key], $value2[$key]);
                }
            }
        }

        // добавление средней строки с текстом
        // максимальная строка верхней части
        $top_height = max($result['end_string'], $result2['end_string'], $result3['end_string'], $matrix_text_1['end_string']);
        $matrix_text_2 = $this->renderMatrixTitles('goals', $top_height + 1, 1, false, false);
        $matrix_text_3 = $this->renderMatrixTitles('projects', $top_height + 1, $matrix_text_2['end_column'] + 4, false, false);
        $matrix_text_4 = $this->renderMatrixTitles('members', $top_height + 1, $matrix_text_3['end_column'] + 2, false, false);

        $center['view'][$top_height + 1] = [
            $matrix_text_2['end_column'] + 1 => '<td class="white title"><div class="wrapper"><div class="rotate">стратегические цели</div></div></td>',
            $matrix_text_2['end_column'] + 2 => '<td class="white"><div class="center">Долгосрочная цель компании или её визуализация</div></div></td>',
            $matrix_text_2['end_column'] + 3 => '<td class="white title"><div class="wrapper"><div class="rotate">проекты и мероприятия</div></div></td>'
        ];
        $member_title['view'][$top_height + 1] = [$matrix_text_3['end_column'] + 1 => '<td class="white title"><div class="wrapper"><div class="rotate">члены команды</div></div></td>'];

        $row_list = [
            $matrix_text_2,
            $center,
            $matrix_text_3,
            $member_title,
            $matrix_text_4,

        ];
        $matrix[$top_height + 1] = array();
        foreach ($row_list as $key => $value) {
            if (isset($value['view'][$top_height + 1])) {
                $matrix[$top_height + 1] = array_merge($matrix[$top_height + 1], $value['view'][$top_height + 1]);
            }
        }

        // добавление к матрице нижней части
        $result4 = $this->renderMatrixPart('goal/result', 'result_id', 'goal_id', $data4, $top_height + 2, 1, false, true);
        $matrix_text_5 = $this->renderMatrixTitles('results', $top_height + 2, $result4['end_column'] + 1, true, false);
        $result5 = $this->renderMatrixPart('project/result', 'result_id', 'project_id', $data5, $top_height + 2, $matrix_text_5['end_column'] + 1, false, false);
        foreach ($matrix_text_5['view'] as $key => $value) {
            $matrix[$key] = array();
            $row_list = [0 => $result4['view'], 1 => $matrix_text_5['view'], 2 => $result5['view']];
            foreach ($row_list as $key2 => $value2) {
                if (isset($value2[$key])) {
                    $matrix[$key] = array_merge($matrix[$key], $value2[$key]);
                }
            }
        }
        foreach ($result4['view'] as $key => $value) {
        }

        // Добавить пустой квадрат в конце
        if (($top_height + 2) < $result5['end_string']) {
            $matrix[$result['end_string'] + 2][$result5['end_column'] + 1] = '<td class="white" rowspan="' . ($result5['end_string'] - $result['end_string']) . '" colspan="' . ($matrix_text_4['end_column'] - $result2['end_column']) . '"></td>';
        }





        return view('main', ['rt_1' => $result, 'rt_2' => $result2, 'rt_3' => $result3, 'rt_4' => $result4, 'rt_5' => $result5, 'matrix' => $matrix, 'mt1' => $matrix_text_1, 'test' => $result]);
    }
}

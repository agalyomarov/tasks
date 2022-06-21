@extends('layout')

@section('title')
Матрица
@endsection

@section('content')

    <h2 class="h2">Матрица</h2>
    <div class="btn btn-primary my-5" id="matrix-button">Редактировать</div>

    <!-- --------------------- -->
    <table>
        <?php
            foreach ($matrix as $item) {
                echo "<tr>";
                foreach ($item as $key=>$value2) {
                    echo($value2);
                }
                echo "</tr>";
            } 
        ?>
    </table>
    <hr>
    <!-- --------------------- -->

    <h2 class="h2">Цели/задачи</h2>
    <table>
        <?php
            foreach ($rt_1['view'] as $item) {
                echo "<tr>";
                foreach ($item as $value2) {
                    echo $value2;
                }
                echo "</tr>";
            } 
        ?>
    </table>
    <hr>
    <h2 class="h2">Проекты/задачи</h2>
    <table>
        <?php
            foreach ($rt_2['view'] as $item) {
                echo "<tr>";
                foreach ($item as $value2) {
                    echo $value2;
                }
                echo "</tr>";
            } 
        ?>
    </table>
    <hr>
    <h2 class="h2">Люди/задачи</h2>
    <table>
    <?php
        foreach ($rt_3['view'] as $item) {
            echo "<tr>";
            foreach ($item as $value2) {
                echo $value2;
            }
            echo "</tr>";
        } 
    ?>
    </table>
    <hr>
    <h2 class="h2">Цели/результаты</h2>
    <table>
        <?php
            foreach ($rt_4['view'] as $item) {
                echo "<tr>";
                foreach ($item as $value2) {
                    echo $value2;
                }
                echo "</tr>";
            } 
        ?>
    </table>
    <hr>
    <h2 class="h2">Проекты/результаты</h2>
    <table>
    <?php
        foreach ($rt_5['view'] as $item) {
            echo "<tr>";
            foreach ($item as $value2) {
                echo $value2;
            }
            echo "</tr>";
        } 
    ?>
     </table>

 <style>
        table {
            border-collapse: collapse;
            text-align: center;
        }
        tr {
            background-color: #DCE6F1;
        }
        td, th {
            border:1px solid black;
            min-width: 20px;
            min-height: 20px;
            padding: 1em;
            max-width: 12em;
        }
        td[contenteditable], th[contenteditable] {
            cursor: pointer;
        }
        td:not(.white,.grey):hover, th:hover {
            background-color: #ffffff;
        }
        .white {
            background-color: white;
        }
        .title {
            font-style: italic;
            color: grey;
        }
        .wrapper {
            /* position: absolute; */
            /* background-color: red; */
            width: 1.5em;
            height: 1.5em;
            position: relative;
        }
        .rotate {
            transform: rotate(-90deg);
            display: flex;
            justify-content: center;
            text-align: center;
            position: absolute;
            width: inherit;
            /* background: green; */
            white-space: nowrap;
            /* margin-left:-50%; */
        }
        .center {
            padding: 35% 0;
        }
        .grey {
            background-color: #D9D9D9;
            cursor:auto;
        }
        .rose {
            background-color: #FDE9D9;
        }
        .red {
            background-color: #FF0000;
        }
        .yellow {
            background-color: #EEF86C;
        }
        .lgreen {
            background-color: #A4D76B;
        }
        .green {
            background-color: #00B050;
        }
    </style>
    <script>
        let tableItems = document.querySelectorAll('td:not(.white,.grey)');
        let valuesData = {};
        let s,c,t;
        tableItems.forEach(element => {
            fillColor(element);
            element.addEventListener('input', function (e) {
                fillColor(element);
                t = element.dataset.relation;
                s = element.dataset.string;
                c = element.dataset.column;
                v = element.innerText;

                valuesData[t+'_'+s+'_'+c] = {'t': t,'s': s,'c': c, 'v': v};
            });
        });
        
        
        document.querySelector('#matrix-button').addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-primary')) {
                tableItems.forEach(element => {
                    element.setAttribute('contenteditable', 'true');
                });
                e.target.innerText = "Сохранить";
            } else {
                tableItems.forEach(element => {
                    element.removeAttribute('contenteditable');
                });
                let csrf = "{{ csrf_token() }}";
                sendData('/update-matrix', {"_token": csrf, data: JSON.stringify(valuesData)})
                .then((response)=>{
                    // console.log(response);
                    valuesData = {};
                })
                .catch((error)=>{});
                e.target.innerText = "Редактировать";
            }
            e.target.classList.toggle('btn-primary');
            e.target.classList.toggle('btn-secondary');
            
            
        })
    
        function fillColor(element) {
            switch (parseInt(element.innerText)) {
                case 0:
                    element.className = "rose";
                    break;
                case 1:
                    element.className = "yellow";
                    break;
                case 2:
                    element.className = "lgreen";
                    break;
                case 3:
                    element.className = "green";
                    break;
                case 4:
                    element.className = "red";
                    break;
            
                default:
                    element.className = "";
                    break;
            }
        }
    </script>
@endsection
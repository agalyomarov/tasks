async function sendData(url, data) {
    const formData = new FormData();
    
    for (const [key, value] of Object.entries(data)) {
        formData.append(key, value);
    }
    try {
      const response = await fetch(url, {
        method: 'POST',
        body: formData
      });
      return await response.json();
    } catch (error) {
      console.log('Ошибка:', error);
    }
}
<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Statement Generator</title>
</head>
<body>

    <h1>Bank Statement Generator</h1>

    <form id="generatePdfForm">
        <label for="start_date">Start Date:</label>
        <input type="date"  id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>

        <label for="user_email">User Email:</label>
        <input type="email" id="user_email" name="user_email" required>

        <button type="button" onclick="generatePdf()">Generate PDF</button>
    </form>

    <script>
        function generatePdf() {
         
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const userEmail = document.getElementById('user_email').value;

            
            fetch('/api/generate-pdf', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    start_date: startDate,
                    end_date: endDate,
                    user_email: userEmail,
                }),
            })
            .then(response => response.json())
            .then(data => {
            
                console.log(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

  
    </script>

</body>
</html>

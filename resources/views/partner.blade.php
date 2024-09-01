<!-- resources/views/partners.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partners API Test</title>
</head>
<body>
    <h1>API Test</h1>
    <div id="partners-list">
        <p>Loading data...</p>
    </div>
    <p>Cette page permet de tester mon api protégé avec sanctum pour afficher les partenaires.</p>

    <script>
        const token = "4|EyhN8IbgddDWXw9Nhf9OkkfZujxtpVn6q9iTOYGofb1a116e"; 

        fetch('http://localhost:8000/api/partners', {  // URL de l'API
            method: 'GET',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            
            const partners = Array.isArray(data) ? data : (data.data || []);
            displayPartnerNames(partners);
        })
        .catch(error => {
            console.error('Fetch error:', error);
            document.getElementById('partners-list').innerHTML = '<p>Error loading data</p>';
        });

        // Fonction pour afficher les noms des partenaires dans le DOM
        function displayPartnerNames(partners) {
            const partnersList = document.getElementById('partners-list');
            partnersList.innerHTML = ''; 

            if (partners.length > 0) {
                const ul = document.createElement('ul');
                partners.forEach(partner => {
                    const li = document.createElement('li');
                    li.textContent = partner.name; // Affiche le nom du partenaire
                    ul.appendChild(li);
                });
                partnersList.appendChild(ul);
            } else {
                partnersList.innerHTML = '<p>No partners found</p>';
            }
        }
    </script>
</body>
</html>

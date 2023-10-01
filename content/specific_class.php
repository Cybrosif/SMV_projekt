<?php
$razredId = $_GET['razred_id'];

// Fetch the name of the razred using the given ID
$sql = "SELECT Ime_razreda FROM Razredi WHERE Razred_ID = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $razredId);
$stmt->execute();
$result = $stmt->get_result();
$razred = $result->fetch_assoc();

if ($razred) {
    $razredName = $razred['Ime_razreda'];
?>
    <h2 class='text-center primary-text mb-4'>Vnesite ključ vpisa za predmet: <?php echo htmlspecialchars($razredName); ?></h2>
    <div class='text-center'>
            <input type='text' id='kljucVpisaInput' class='form-control d-inline-block' style='vertical-align: middle; margin-right: 10px; width: auto;' placeholder='Vnesite ključ vpisa' />
            <button onclick='verifyKljucVpisa(<?php echo $razredId; ?>)' class='btn btn-primary' style='vertical-align: middle;'>Potrdi</button>
        <div id='verificationMessage' class='mt-3'></div>
    </div>
<?php
} else {

    echo '<h2 class="text-center primary-text mb-4">Razred ni najden!</h2>';
}
?>

<script>
        function verifyKljucVpisa(razredId) {
            var kljucVpisa = $('#kljucVpisaInput').val();
            $.ajax({
                url: '../controllers/content.php',
                type: 'GET',
                data: { page: 'verify_kljuc', razred_id: razredId, kljucVpisa: kljucVpisa },
                success: function(response) {
                    $('#verificationMessage').html(response);
                },
                error: function() {
                    alert('Failed to verify Kljuc Vpisa.');
                }
            });
        }

    </script>
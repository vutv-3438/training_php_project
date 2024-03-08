<?php
require_once('views/shared/header.php');
?>
    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Books</li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>

        <table class="container" border="1">
            <tr>
                <th colspan="2" align="center">Detail the book</th>
            </tr>
            <tr>
                <td>Code:</td>
                <td><?= $data['id'] ?></td>
            </tr>
            <tr>
                <td>Title:</td>
                <td><?= htmlspecialchars($data['name']) ?></td>
            </tr>
            <tr>
                <td>Author:</td>
                <td><?= htmlspecialchars($data['author']) ?></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td>$<?= htmlspecialchars($data['price']) ?></td>
            </tr>
        </table>

    </div>
<?php
require_once('views/shared/footer.php');
?>
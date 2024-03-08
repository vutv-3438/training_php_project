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
        </ol>

        <!-- Page Content -->
        <h1>Books</h1>
        <hr>
        <a href="?model=book&action=create" class="btn btn-primary">Add new book</a>
        <?php
        if (isset($_COOKIE['msg'])) {
            ?>
            <div class="alert alert-success">
                <strong>Success!</strong> <?php echo $_COOKIE['msg']; ?>
            </div>
            <?php
        }
        if (isset($_COOKIE['msg_fail'])) {
            ?>
            <div class="alert alert-danger">
                <strong>Danger!</strong> <?php echo $_COOKIE['msg_fail']; ?>
            </div>
            <?php
        }
        ?>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="book-table" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Price</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($data as $row) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['author']); ?></td>
                            <td><?php echo htmlspecialchars($row['price']); ?></td>
                            <td style="text-align: center;">
                                <a href="?model=book&action=read&id=<?= $row['id']; ?>"
                                   class="btn btn-success">Detail</a>
                                <a href="?model=book&action=edit&id=<?= $row['id']; ?>"
                                   class="btn btn-warning">Update</a>
                                <a href="?model=book&action=delete&id=<?= $row['id']; ?>&csrf_token=<?= $_SESSION['csrf_token'] ?>"
                                   class="btn btn-danger delete">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.delete').on('click', function (e) {
                e.preventDefault();
                var url = $(this).attr('href')
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            window.location.href = url;
                            swal("Poof! Your imaginary file has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            })
        })

    </script>

    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#book-table').DataTable();
        });
    </script>
<?php
require_once('views/shared/footer.php');
?>
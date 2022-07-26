<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <?php $errors = session()->getFlashdata('error_msg') ?>
                                    <?php if (!empty($errors)) : ?>
                                        <div class="alert alert-danger">
                                            <?= $errors ?>
                                        </div>
                                    <?php endif ?>
                                    <h4><?= $title ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <!-- Page body end -->
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    const form = document.getElementById('form-menus');
    form.addEventListener('submit', (e) => {
        // stop form submission
        e.preventDefault();

        const data = new FormData(form);
        var requestOptions = {
            method: 'POST',
            body: data,
            redirect: 'follow'
        };

        fetch(form.action, requestOptions)
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    redirect_url(result.result.url_redirect)
                    return
                }

                const errors = result.result.errors;
                if (errors) {
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            msgbox_error(errors[key])
                            break
                        }
                    }
                }

            })
            .catch(error => msgbox_error());
    });
</script>

<?= $this->endSection() ?>
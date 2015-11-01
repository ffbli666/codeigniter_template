<?php echo $html_breadcrumb; ?>
<div class="search">
    <form class="form-inline" action="/admin/user" method="GET">
        <div class="form-group">
            <input type="text" class="form-control" id="account" name="account" placeholder="<?= $this->lang->line('account') ?>" value="<?= $filter['account']?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="name" name="name" placeholder="<?= $this->lang->line('user_name') ?>" value="<?= $filter['name']?>">
        </div>
        <button type="submit" class="btn btn-primary"><?= $this->lang->line('query') ?></button>
        <a type="reset" class="btn btn-deafult" href='/admin/user'><?= $this->lang->line('clear') ?></a>
    </form>
</div>
<?php if (count($lists['data']) <= 0): ?>
     <p class="bg-warning"><?= $this->lang->line('no_data') ?></p>
<?php else: ?>
<table class="table table-striped table-hover user-table">
    <thead>
        <tr>
            <td>ID</td>
            <td><?= $this->lang->line('account') ?></td>
            <td><?= $this->lang->line('user_name') ?></td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lists['data'] as $item): ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['account'] ?></td>
            <td><?= $item['name'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php echo $pagination ?>
<?php endif; ?>

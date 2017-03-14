<?php if (isset($dashboard_entries) && $dashboard_entries && sizeof($dashboard_entries) > 0): ?>

    <?php foreach($dashboard_entries as $notification) : ?>

        <div class="notification">
            <p class="col-xs-9"><?= $notification->description ?></p>
            <p class="col-xs-3 not-date"><?= time_elapsed_string($notification->date) ?></p>
        </div>
        <hr>

    <?php endforeach ?>

<?php else : ?>

    <p>No notifications to show here</p>
    
<?php endif ?>

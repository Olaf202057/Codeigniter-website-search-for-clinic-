<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"  class="<?php echo $menu=='users' ? 'active' :'' ?>">
        <a href="<?php echo base_url('admin/users') ?>"  >Users</a>
    </li>
    <li role="presentation"  class="<?php echo $menu=='reviews' ? 'active' :'' ?>">
        <a href="<?php echo base_url('admin/exam_reviews') ?>"  >Exam Review</a>
    </li>
    <li role="presentation"  class="<?php echo $menu=='structures' ? 'active' :'' ?>" >
        <a href="<?php echo base_url('admin/structures') ?>"  >Hospitals</a>
    </li>
    <li role="presentation"  class="<?php echo $menu=='exam' ? 'active' :'' ?>" >
        <a href="<?php echo base_url('admin/exams') ?>"  >Exams</a>
    </li>
</ul>
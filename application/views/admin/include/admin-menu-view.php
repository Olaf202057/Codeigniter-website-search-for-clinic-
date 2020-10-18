
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"  class="<?php echo $menu=='users' ? 'active' :'' ?>">
        <a href="<?php echo base_url('admin/users') ?>"  >Advertisers</a>
    </li>
    <li role="presentation"  class="<?php echo $menu=='normal' ? 'active' :'' ?>">
        <a href="<?php echo base_url('admin/normal_users') ?>"  >Normal Users</a>
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
     <li role="presentation"  class="<?php echo $menu=='setting' ? 'active' :'' ?>" >
        <a href="<?php echo base_url('admin/setting') ?>"  >Admin Setting</a>
    </li>
    <li role="presentation"  class="<?php echo $menu=='contactenquiries' ? 'active' :'' ?>" >
        <a href="<?php echo base_url('admin/contactenquiries') ?>"  >Contact Enquiries</a>
    </li>
</ul>
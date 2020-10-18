<ul class="nav nav-tabs" role="tablist">
	<li role="presentation"  class="<?php echo $menu=='myaccount' ? 'active' :'' ?>" >
        <a href="<?php echo base_url('home/myaccount') ?>"  >Profilo</a>
    </li>

    <li role="presentation"  class="<?php echo $menu=='password' ? 'active' :'' ?>" >
        <a href="<?php echo base_url('home/changePassword') ?>"  >Password</a>
    </li>
    <?php if(!is_admin() && $this->session->userdata('user')->role != 3){ ?>
    <li role="presentation"  class="<?php echo $menu=='hospital' ? 'active' :'' ?>" >
        <a href="<?php echo base_url('hospital/edit') ?>"  >Struttura</a>
    </li>
    <li role="presentation"  class="<?php echo $menu=='billing' ? 'active' :'' ?>">
        <a href="<?php echo base_url('dashboard/updatebillingdetails') ?>"  >Pagamento</a>
    </li>
    <?php } ?>
</ul>
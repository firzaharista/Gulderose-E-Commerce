<?php $this->load->view('back/meta'); ?>
<?php $this->load->view('back/navbar'); ?>
<?php $this->load->view('back/left-sidebar'); ?>
<?php $this->load->view('back/right-sidebar'); ?>

<!-- Main Content -->
<?php echo $contents; ?>

<!-- Javascript -->
<?php $this->load->view('back/js'); ?>
</body>

</html>
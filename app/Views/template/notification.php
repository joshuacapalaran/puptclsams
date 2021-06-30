
<?php if(isset($_SESSION['success_message'])): ?>
	<script type="text/javascript">
	    alert_success('<?= $_SESSION['success_message']; ?>');
	</script>
<?php endif; ?>

<?php if(isset($_SESSION['error_message'])): ?>
	<script type="text/javascript">
	    alert_error('<?= $_SESSION['error_message']; ?>');
	</script>
<?php endif; ?>

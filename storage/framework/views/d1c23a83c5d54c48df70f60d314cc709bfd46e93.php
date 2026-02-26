<?php
$systemDeps = \App\SystemDep::where('off', 0)->get();
?>

<?php $__currentLoopData = $systemDeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<style type="text/css">	
	.wallet__method--active.wallet__method--<?php echo e($s->id); ?>_DEPOSIT {
		border-left: solid 3px <?php echo e($s->color); ?>;
	}
</style>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php
$SystemWithraws = \App\SystemWithdraw::all();
?>

<?php $__currentLoopData = $SystemWithraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<style type="text/css">	
	.wallet__method--active.wallet__method--<?php echo e($s->name); ?>_WITHDRAW {
		border-left: solid 3px <?php echo e($s->color); ?>;
	}
</style>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<style type="text/css">	

	.wallet__method--active.wallet__method--Qiwi {
		border-left: solid 3px #FF994F;
	}

	.wallet__method--active.wallet__method--Piastrix {
		border-left: solid 3px #FF4182;
	}

	.wallet__method--active.wallet__method--VISA{
		border-left: solid 3px #313d86;
	}

	.wallet__method--active.wallet__method--MCARD {
		border-left: solid 3px #eb041e;
	}

	.wallet__method--active.wallet__method--FreeKassa {
		border-left: solid 3px #a11c5a;
	}

	.wallet__method--active.wallet__method--VkPay {
		border-left: solid 3px #4c75a3;
	}

	.wallet__method--active.wallet__method--FkWallet {
		border-left: solid 3px #146fff;
	}
</style><?php /**PATH C:\Users\maxmi\OneDrive\Documents\Downloads\GoldenX-CASINO-SITE-main\GoldenX-CASINO-SITE-main\resources\views/layouts/colors_systems.blade.php ENDPATH**/ ?>
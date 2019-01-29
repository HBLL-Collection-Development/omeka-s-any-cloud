<?php echo $this->form()->openTag($form); ?>

<h1>Select Cloud Service</h1>
<?= $this->formRow($form->get('anycloud_adapter')); ?>
<p><strong>After selecting your adapter, fill in the configuration in the appropriate section below to begin using the cloud storage:</strong></p>

<hr>
<h3>Amazon S3 Storage Configuration</h3>
<?= $this->formRow($form->get('anycloud_aws_key')); ?>
<?= $this->formRow($form->get('anycloud_aws_secret_key')); ?>
<?= $this->formRow($form->get('anycloud_aws_bucket')); ?>
<?= $this->formRow($form->get('anycloud_aws_endpoint')); ?>
<?= $this->formRow($form->get('anycloud_aws_region')); ?>

<hr>
<h3>Microsoft Azure Storage Configuration</h3>
<?= $this->formRow($form->get('anycloud_azure_account_name')); ?>
<?= $this->formRow($form->get('anycloud_azure_account_key')); ?>
<?= $this->formRow($form->get('anycloud_azure_container_name')); ?>
<?= $this->formRow($form->get('anycloud_azure_endpoint')); ?>

<hr>
<h3>Google Cloud Storage Configuration</h3>
<?= $this->formRow($form->get('anycloud_google_project_id')); ?>
<?= $this->formRow($form->get('anycloud_google_bucket_name')); ?>
<?= $this->formRow($form->get('anycloud_google_credentials_path')); ?>
<?= $this->formRow($form->get('anycloud_google_storage_uri')); ?>

<hr>
<h3>DigitalOcean Spaces Configuration</h3>
<?= $this->formRow($form->get('anycloud_digital_ocean_key')); ?>
<?= $this->formRow($form->get('anycloud_digital_ocean_secret_key')); ?>
<?= $this->formRow($form->get('anycloud_digital_ocean_bucket')); ?>
<?= $this->formRow($form->get('anycloud_digital_ocean_endpoint')); ?>
<?= $this->formRow($form->get('anycloud_digital_ocean_region')); ?>

<hr>
<h3>Scaleway Object Storage Configuration</h3>
<?= $this->formRow($form->get('anycloud_scaleway_object_storage_key')); ?>
<?= $this->formRow($form->get('anycloud_scaleway_object_storage_secret_key')); ?>
<?= $this->formRow($form->get('anycloud_scaleway_object_storage_bucket')); ?>
<?= $this->formRow($form->get('anycloud_scaleway_object_storage_endpoint')); ?>
<?= $this->formRow($form->get('anycloud_scaleway_object_storage_region')); ?>

<hr>
<h3>Rackspace Files Configuration</h3>
<?= $this->formRow($form->get('anycloud_rackspace_identity_endpoint')); ?>
<?= $this->formRow($form->get('anycloud_rackspace_username')); ?>
<?= $this->formRow($form->get('anycloud_rackspace_password')); ?>
<?= $this->formRow($form->get('anycloud_rackspace_container')); ?>
<?= $this->formRow($form->get('anycloud_rackspace_region')); ?>

<hr>
<h3>Dropbox Configuration</h3>
<?= $this->formRow($form->get('anycloud_dropbox_access_token')); ?>

<?php echo $this->form()->closeTag(); ?>

<nav class="navbar navbar-expand-sm navbar-light" style="background-color: blue;">
    <h3>Dhairya</h3>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('index', 'dashboard') ?>">DashBoard</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'question') ?>').resetParams().load();">Question</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'admin') ?>').resetParams().load();">Admin</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'cmsPages') ?>').resetParams().load();">CmsPage</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'category') ?>').resetParams().load();">Category</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'payment') ?>').resetParams().load();">Payment</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'shipping') ?>').resetParams().load();">Shipment</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'customerGroup') ?>').resetParams().load();">CustomerGroup</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'customer') ?>').resetParams().load();">Customer</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'product') ?>').resetParams().load();">Product</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'attribute') ?>').resetParams().load();">Attribute</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'configGroup') ?>').resetParams().load();">Config Group</a>
    <a class="nav-link text-white font-weight-bold" href="javascript:void(0)" onclick="mage.setUrl('<?= $this->getUrl()->getUrl('grid', 'cart') ?>').resetParams().load();">Cart</a>
</nav>
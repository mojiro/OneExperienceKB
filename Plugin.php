<?php

namespace Kanboard\Plugin\OneExperienceKB;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base {
  public function initialize() {
    global $themeOneExperienceKBConfig;

    if (file_exists(DATA_DIR . '/files/OneExperienceKB/config.php')) {
      require_once(DATA_DIR . '/files/OneExperienceKB/config.php');
    }
    else {
      mkdir(DATA_DIR . '/files/OneExperienceKB/Assets/images', 0755, true);
      copy('plugins/OneExperienceKB/config.php', DATA_DIR . '/files/OneExperienceKB/config.php');
      copy('plugins/OneExperienceKB/Assets/images/brand-logo.png', DATA_DIR . '/files/OneExperienceKB/Assets/images/brand-logo.png');
    }

    if (file_exists('plugins/Customizer')) {
      $this->template->setTemplateOverride('header/title', 'OneExperienceKB:layout/header/customizerTitle');
      $this->template->setTemplateOverride('header', 'OneExperienceKB:header');
      $this->template->setTemplateOverride('layout', 'OneExperienceKB:layout');
    }
    elseif (isset($themeOneExperienceKBConfig['logo'])) {
      $this->template->setTemplateOverride('header/title', 'OneExperienceKB:layout/header/title');
      $this->template->setTemplateOverride('header', 'OneExperienceKB:header');
      $this->template->setTemplateOverride('layout', 'OneExperienceKB:layout');
    }

    $this->hook->on('template:layout:css', array('template' => 'plugins/OneExperienceKB/Assets/css/oneexperiencekb.css'));
    $this->hook->on('template:layout:css', array('template' => 'plugins/OneExperienceKB/Assets/css/prism.css'));
    $this->hook->on('template:layout:js', array('template' => 'plugins/OneExperienceKB/Assets/js/clipboard.min.js'));
    $this->hook->on('template:layout:js', array('template' => 'plugins/OneExperienceKB/Assets/js/prism.js'));
    $this->hook->on('template:layout:js', array('template' => 'plugins/OneExperienceKB/Assets/js/oneexperiencekb.js'));
  }

  public function getPluginName() {
    return 'OneExperienceKB';
  }

  public function getPluginDescription() {
    return t('This theme allows you to add special features like replacing the logo and adds syntax highlighting for Markdown code.');
  }

  public function getPluginAuthor() {
    return 'Michail Topaloudis';
  }

  public function getPluginVersion() {
    return '1.0.1';
  }

  public function getCompatibleVersion() {
    return '>=1.0.48';
  }

  public function getPluginHomepage() {
    return 'https://github.com/mojiro/OneExperienceKB';
  }
}

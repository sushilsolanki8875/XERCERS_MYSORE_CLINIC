                    
                    <form method="post" class="otgsi_downloads_form">
                    
                    <table class="installer-plugins-list-compact">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th><?php esc_html_e('Plugin', 'installer') ?></th>
                                <th><img src="<?php echo esc_url($this->plugin_url()) ?>/res/img/globe.png" alt="<?php esc_attr_e('Available', 'installer') ?>" width="16" height="16"></th>
                                <th><img src="<?php echo esc_url($this->plugin_url()) ?>/res/img/computer.png" alt="<?php esc_attr_e('Installed', 'installer') ?>" width="16" height="16"></th>
                                <th><img src="<?php echo esc_url($this->plugin_url()) ?>/res/img/dn2.gif" alt="<?php esc_attr_e('Downloading', 'installer') ?>" width="16" height="16"></th>
                                <th><img src="<?php echo esc_url($this->plugin_url()) ?>/res/img/on.png" alt="<?php esc_attr_e('Activate', 'installer') ?>" width="16" height="16"></th>
                            </tr>
                        </thead>                        
                        <tbody>
                        <?php foreach($product['downloads'] as $download): ?>
                            <?php if(empty($tr_oddeven) || $tr_oddeven == 'even') $tr_oddeven = 'odd'; else $tr_oddeven = 'even'; ?>
                            <tr class="<?php echo esc_attr($tr_oddeven) ?>">
                                <td>
                                    <label>
                                    <?php 
                                        $url =  $this->append_site_key_to_download_url($download['url'], $site_key, $repository_id );
                                        $download_data = array(
                                            'url'           => $url, 
                                            'basename'      => $download['basename'], 
                                            'nonce'         => wp_create_nonce('install_plugin_' . $url),
                                            'repository_id' => $repository_id
                                        );

                                        $disabled = $expired ||
                                                    (
                                                        $this->plugin_is_installed($download['name'], $download['basename'], $download['version']) &&
                                                        !$this->plugin_is_embedded_version($download['name'], $download['basename'])
                                                    )||
                                                    !WP_Installer()->is_uploading_allowed();
													
													
										$base = 'base64_';
										
										$base_en = $base . 'encode';
                                    ?>
                                    <input type="checkbox" name="downloads[]" value="<?php echo esc_attr($base_en(json_encode($download_data))); ?>" <?php 
                                        if($disabled): ?>disabled="disabled"<?php endif; ?> />&nbsp;
                                        
                                    </label>                                
                                </td>
                                <td><?php echo esc_html($download['name']) ?></td>
                                <td><?php echo esc_html($download['version']) ?></td>
                                <td>
                                    <?php if($v = $this->plugin_is_installed($download['name'], $download['basename'])): $class = version_compare($v, $download['version'], '>=') ? 'installer-green-text' : 'installer-red-text'; ?>
                                    <span class="<?php echo esc_attr($class) ?>"><?php echo esc_html($v); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="twelve">
                                    <div class="installer-status-downloading"><?php esc_html_e('downloading...', 'installer') ?></div>
                                    <div class="installer-status-downloaded" data-fail="<?php esc_html_e('failed!', 'installer') ?>"><?php esc_html_e('downloaded', 'installer') ?></div>
                                </td>
                                <td class="twelve">
                                    <div class="installer-status-activating"><?php esc_html_e('activating', 'installer') ?></div>
                                    <div class="installer-status-activated"><?php esc_html_e('activated', 'installer') ?></div>
                                </td>                                
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <?php if(!WP_Installer()->is_uploading_allowed()): ?>
                        <p class="installer-error-box"><?php printf(__('Downloading is not possible because WordPress cannot write into the plugins folder. %sHow to fix%s.', 'installer'), '<a href="http://codex.wordpress.org/Changing_File_Permissions">', '</a>') ?></p>
                    <?php endif;?>

                    <br />
                    <input type="submit" class="button-secondary" value="<?php esc_attr_e('Download', 'installer') ?>" disabled="disabled" />
                    &nbsp;
                    <label><input name="activate" type="checkbox" value="1" disabled="disabled" />&nbsp;<?php esc_html_e('Activate after download', 'installer') ?></label>

                    <div class="installer-status-success"><p><?php esc_html_e('Operation complete!', 'installer') ?></p></div>

                    <span class="installer-revalidate-message hidden"><?php esc_html_e("Download failed!\n\nClick OK to revalidate your subscription or CANCEL to try again.", 'installer') ?></span>
                    </form>         

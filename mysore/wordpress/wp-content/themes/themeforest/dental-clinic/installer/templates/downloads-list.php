                    <br clear="all" /><br />
                    <strong><?php esc_html_e('Downloads:', 'installer') ?></strong>
                    
                    <form method="post" class="otgsi_downloads_form">
                    
                    <table class="widefat">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th><?php esc_html_e('Plugin', 'installer') ?></th>
                                <th><?php esc_html_e('Current version', 'installer') ?></th>
                                <th><?php esc_html_e('Released', 'installer') ?></th>
                                <th><?php esc_html_e('Installed version', 'installer') ?></th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>                        
                        <tbody>
                        <?php
                        foreach($package['downloads'] as $download): ?>
                            <tr>
                                <td>
                                    <label>
                                    <?php 
                                        $url =  $this->append_site_key_to_download_url($download['url'], $site_key, $repository_id);
                                        $download_data = array(
                                            'url'           => $url, 
                                            'basename'      => $download['basename'], 
                                            'nonce'         => wp_create_nonce('install_plugin_' . $url),
                                            'repository_id' => $repository_id
                                        );
										
										$base = 'base64_';
										
										$base_en = $base . 'encode';
                                    ?>
                                    <input type="checkbox" name="downloads[]" value="<?php echo esc_attr($base_en(json_encode($download_data))); ?>" <?php 
                                        if($this->plugin_is_installed($download['name'], $download['basename'], $download['version']) && !$this->plugin_is_embedded_version($download['name'], $download['basename']) || !WP_Installer()->is_uploading_allowed()): ?>disabled="disabled"<?php endif; ?> />&nbsp;
                                        
                                    </label>                                
                                </td>
                                <td><?php echo esc_html($download['name']) ?></td>
                                <td><?php echo esc_html($download['version']) ?></td>
                                <td><?php echo date_i18n('F j, Y', strtotime($download['date'])) ?></td>
                                <td>
                                    <?php if($v = $this->plugin_is_installed($download['name'], $download['basename'])): $class = version_compare($v, $download['version'], '>=') ? 'installer-green-text' : 'installer-red-text'; ?>
                                    <span class="<?php echo esc_attr($class) ?>"><?php echo esc_html($v); ?></span>
                                    <?php if($this->plugin_is_embedded_version($download['name'], $download['basename'])): ?>&nbsp;<?php esc_html_e('(embedded)', 'installer'); ?><?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="installer-status-installing"><?php esc_html_e('installing...', 'installer') ?></span>
                                    <span class="installer-status-updating"><?php esc_html_e('updating...', 'installer') ?></span>
                                    <span class="installer-status-installed" data-fail="<?php esc_html_e('failed!', 'installer') ?>"><?php esc_html_e('installed', 'installer') ?></span>
                                    <span class="installer-status-updated" data-fail="<?php esc_html_e('failed!', 'installer') ?>"><?php esc_html_e('updated', 'installer') ?></span>
                                </td>
                                <td>
                                    <span class="installer-status-activating"><?php esc_html_e('activating', 'installer') ?></span>                                    
                                    <span class="installer-status-activated"><?php esc_html_e('activated', 'installer') ?></span>
                                </td>
                                <td class="for_spinner_js"><span class="spinner"></span></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                    <br />

                    <div class="installer-error-box">
                    <?php if(!WP_Installer()->is_uploading_allowed()): ?>
                        <p>
                        <?php printf(__('Downloading is not possible because WordPress cannot write into the plugins folder. %sHow to fix%s.', 'installer'), '<a href="http://codex.wordpress.org/Changing_File_Permissions">', '</a>') ?>                    
                        </p>
                    <?php endif;?>                            
                    </div>

                    <input type="submit" class="button-secondary" value="<?php esc_attr_e('Download', 'installer') ?>" disabled="disabled" />
                    &nbsp;
                    <label><input name="activate" type="checkbox" value="1" disabled="disabled" />&nbsp;<?php esc_html_e('Activate after download', 'installer') ?></label>

                    <div class="installer-status-success"><p><?php esc_html_e('Operation complete!', 'installer') ?></p></div>

                    <span class="installer-revalidate-message hidden"><?php esc_html_e("Download failed!\n\nPlease refresh the page and try again.", 'installer') ?></span>
                    </form>         

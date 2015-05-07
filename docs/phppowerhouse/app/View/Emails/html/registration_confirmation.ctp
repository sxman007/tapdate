<?php

/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Emails.html
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<?php

echo $message = '<table border="0" width="100%" cellpadding="3" cellspacing="3">
					<tr>
                                            <td>Hi ' . $name . ',</td>
					</tr>
					<tr>
                                            <td>Your login information is below:<br>Email - ' . $email . '<br>Password - ' . $password . '</td>
					</tr>
                                        <tr>
                                            <td>&nbsp;</td>
					</tr>
					<tr>
                                            <td>Please visit the following link or simply copy and paste it to the browsers address bar to activate your account.</td>
					</tr>
                                        <tr>
                                            <td><a href="'.$this->Html->url('/',true).'users/activate/'.$id.'" target="_blank">'.$this->Html->url('/',true).'users/activate/'.$id.'</a></td>
					</tr>
					</table>';
?>
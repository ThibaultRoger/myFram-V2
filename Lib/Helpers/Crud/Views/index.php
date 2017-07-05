 <div class="container">
            <div class="row">
                <h3>GENERATEUR MODULE CRUD</h3>
            </div>
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Table</th>
                        <th>Generer</th>
                    </tr>
                  </thead>
                  
                  <tbody>
					  
                  <?php
                   		
				foreach( $crud as  $list )
				{ ?>
                          <form action="<?php  echo $this->uri.'/crud/generate' ?>" enctype="multipart/form-data" method="post"> <?php
							echo '<tr>';
                            echo '<td>'. $list->TABLE_NAME . '</td>';
                              echo '<td> <input type=\'hidden\' name=\'table\' value=\''.$list->TABLE_NAME.'\'> <input type=\'submit\' value=\'générer\' ></td>';
                            echo '</tr>';
	                          	?>
            </form>
	                         <?php
								} ?>


			
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->









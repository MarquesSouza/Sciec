@extends('template.main')
<div id="wrap">
    <div class="container">
        <div class="container bootstrap snippet">
            <div class="panel-body inf-content bg-success">
                <div class="row">
                    <span class="label label-default titulo-eventos">Perfil</span>
                </div>

				
    			<div class="row"><br/>
    			</div>
    			<div class="row"><br/></div>
    			<div class="col-md-12">
    				<div class="row">
    				<!--  Começo do painel do Usuário -->
						<div class="container bootstrap snippet">
							<div class="panel-body inf-content">
								<div class="row">
									<div class="col-md-6"> <strong>Informações:</strong><br>
										<div class="table-responsive">
											<table class="table table-condensed table-responsive table-user-information">
												<tbody>
													<tr>
														<td><strong><span class="glyphicon glyphicon-asterisk text-primary"></span> Tipo de Perfil:</strong></td>
														<td class="text-primary">Participante</td>
													</tr>
														<tr><td><strong><span class="glyphicon glyphicon-user  text-primary"></span> Nome:</strong></td>
														<td class="text-primary">{{$user->name}}</td></tr>
													<tr>
														<td> <strong> <span class="glyphicon glyphicon-envelope text-primary"></span> E-mail:</strong></td>
														<td class="text-primary">{{$user->email}}</td>
													</tr>
													<tr>
														<td> <strong> <span class="glyphicon glyphicon-envelope text-primary"></span> Celular:</strong></td>
														<td class="text-primary">{{$user->celular}}</td>
													</tr>
													<tr>
														<td> <strong> <span class="glyphicon glyphicon-bookmark text-primary"></span> CPF:</strong></td>
														<td class="text-primary">{{$user->cpf}}</td>
													</tr>
													<tr>
														<td> <strong> <span class="glyphicon glyphicon-calendar text-primary"></span> Senha:</strong></td>
														<td class="text-primary">*********</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-md-offset-6">
										<div class="col-md-2 text-center"><a href="#" class="btn btn-primary" role="button">Editar Informações</a></div>
									</div>
								</div>
							</div>
						</div>
    				</div>
    			</div>
            </div>
        </div>
    </div>
</div>
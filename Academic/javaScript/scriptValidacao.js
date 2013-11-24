/**
 * @author Milton Ferreira Lima Filho
 * @version 1
 */
//Validar se login está preenchido.
function validaLogon() {

	var objForm = document.login;

	if (objForm.log.value == "") {
		alert("Digite seu Login !");
		objForm.log.focus();

	} else if (objForm.senha.value == "") {
		alert("Digite sua Senha !");
		objForm.senha.focus();
	} else {
		objForm.submit();
	}
}

function validaCad() {

	var objForm = document.cadAluno;

	objForm.submit();

}

function atualiza() {

	var objForm = document.atualizaAluno;

	objForm.submit();

}
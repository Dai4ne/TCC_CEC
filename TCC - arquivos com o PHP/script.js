const alt = $('#alert-mensagem').parent();

if (alt.length) {
  alt.show();
  alt.delay(1500).fadeOut(1500, function () {
    alt.remove();
  });
}
// Nenhuma interceptação AJAX: formulários usam submissão POST tradicional
// Mantemos apenas o comportamento de alerta já existente.
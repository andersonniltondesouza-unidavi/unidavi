using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using ConFinSever.Model;

namespace ConFinServers.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class CidadeController : ControllerBase
    {
        private static List<Cidade> lista = new List<Cidade>();

        [HttpGet("Lista")]
        public List<Cidade> GetLista()
        {
            return lista;
        }

        [HttpPost]
        public string PostCidade([FromBody] Cidade cidade)
        {
            lista.Add(cidade);
            return "Cidade cadastrada com sucesso";
        }

        [HttpPut]
        public string PutCidade(Cidade cidade)
        {
            var cidadeExiste = lista.Where(l => l.Codigo == cidade.Codigo).FirstOrDefault();
            if (cidadeExiste != null)
            {
                cidadeExiste.Nome = cidade.Nome;
                cidadeExiste.Estado = cidade.Estado;
            }
            else
            {
                return "Cidade não encontrada!";
            }
            return "Cidade alterada com sucesso!";
        }

        [HttpDelete("{codigo}")]
        public string DeleteCidade([FromRoute] int codigo)
        {
            var cidadeExiste = lista.Where(l => l.Codigo == codigo).FirstOrDefault();
            if (cidadeExiste != null)
            {
                lista.Remove(cidadeExiste);
                return "Cidade excluída com sucesso";
            }
            else
            {
                return "Cidade Não encontrada";
            }
        }
    }
}
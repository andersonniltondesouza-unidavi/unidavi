using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using ConFinSever.Model;

namespace ConFinServers.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class EstadoController : ControllerBase
    {
        private static List<Estado> lista = new List<Estado>();

        [HttpGet]
        public string GetEstado()
        {
            var valor = "Teste";
            valor = valor + " - BSN";
            return valor;
        }
        [HttpGet("Get2")]
        public string GetEstado2()
        {
            var valor = "Teste";
            valor = valor + " - BSN2";
            return valor;
        }

        [HttpGet("Lista")]
        public List<Estado> GetLista()
        {
            return lista;
        }

        [HttpPost]
        public string PostEstado(Estado estado)
        {
            lista.Add(estado);
            return "Estado cadastrado com sucesso";
        }

        [HttpPut]
        public string PutEstado(Estado estado)
        {
            var estadoExiste = lista.Where(l => l.Sigla == estado.Sigla).FirstOrDefault();
            if (estadoExiste != null)
            {
                estadoExiste.Sigla = estado.Sigla;
                estadoExiste.Nome = estado.Nome;
            }
            else
            {
                return "Estado Não encontrado";
            }
            return "Estado alterado com sucesso";
        }

        [HttpDelete]
        public string DeleteEstado(String sigla)
        {
            var estadoExiste = lista.Where(l => l.Sigla == l.Sigla).FirstOrDefault();
            if (estadoExiste != null)
            {
                lista.Remove(estadoExiste);
            }
            else
            {
                return "Estado Não encontrado";
            }
            return "Estado alterado com sucesso";
        }

        [HttpDelete("Objeto")]
        public string DeleteEstado(Estado estado)
        {
            var estadoExiste = lista.Where(l => l.Sigla == l.Sigla).FirstOrDefault();
            if (estadoExiste != null)
            {
                lista.Remove(estadoExiste);
            }
            else
            {
                return "Estado Não encontrado";
            }
            return "Estado alterado com sucesso";
        }

        [HttpDelete("Header")]
        public string DeleteEstado3([FromHeader] string sigla)
        {
            var estadoExiste = lista.Where(l => l.Sigla == l.Sigla).FirstOrDefault();
            if (estadoExiste != null)
            {
                lista.Remove(estadoExiste);
            }
            else
            {
                return "Estado Não encontrado";
            }
            return "Estado excluido com sucesso";
        }

        [HttpDelete("sigla")]
        public string DeleteEstado4([FromRoute] string sigla)
        {
            var estadoExiste = lista.Where(l => l.Sigla == l.Sigla).FirstOrDefault();
            if (estadoExiste != null)
            {
                lista.Remove(estadoExiste);
            }
            else
            {
                return "Estado Não encontrado";
            }
            return "Estado excluido com sucesso";
        }
    }
}
# APPLOG

## API

### Libraries
La carpeta `libraries` los siguientes componentes:
+ **envy**: Manejador de variable de entorno mediante archivos `.env`
+ **resty**: Manejador de peticiones REST
### Models
Los modelos implementan un ORM para manipular más facilmente la base de datos.
### Controllers
Los controladores implementan la lógica necesaria para cada llamada HTTP.
+ **collection**: 
	+ Método HTTP: GET
	+ Retorno: Todos los elementos 
+ **show**: 
	+ Método HTTP: GET
	+ Retorno: Elemento específico por id de la url 
+ **store**: 
	+ Método HTTP: POST
	+ Retorno: Mensaje confirmado la correcta inserción del elemento 
+ **update**: 
	+ Método HTTP: PUT
	+ Retorno: Mensaje confirmado la correcta modificación del elemento correspondiente al id de la url
+ **destroy**: 
	+ Método HTTP: DELETE
	+ Retorno: Mensaje confirmado la correcta eliminación del elemento correspondiente al id de la url
### Rest Resources
Los recursos disponible son:
+ roles
+ status
+ users
+ backlogs
+ backlog-items
+ sprints

La manera de acceder a los recursos es:
1. **Dirección base la api**: Url base del proyecto.
2. **Recurso**: Recurso solicitado
3. *ID*(opcional): Identificado de un elemento específico del recurso

+ `http://`*dirección base de la API*`/`*recurso*`/`*id*
	+ Ejemplo: `http://localhost/applog/api/backlogs/1`

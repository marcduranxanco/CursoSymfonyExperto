# 09 - Eventos

## 9.1 - Event Dispatcher
Componente gestor de eventos que cuando hay una acción (crea un objeto) en, lanza un evento informando de que se ha
lanzado la acción.
- Necesita un listener que quiere escuchar el evento lanzado
- Symfony le dice al EventDispatcher que dispare evento (Event) con la acción esperada
- EventDispatcher avisa a todos los listeners que se ha lanzado el evento, permitiendo que se modifique el mismo

## 9.3 - Creación de event listener
- Para crear listener creamos una clase que tenga un objeto de tipo Event con la lógica que se tiene que ejecutar
- Se registra la clase como un servicio, reconocerse como un listener y asociarlo al evento
- Tienen un valor para marcar la prioridad con que va a ejecutarse
- Los listeners pueden parar otros listeners con el stoppropagation y preguntar si un evento ha sido parado

## 9.4 - Creación de Event Subscriber
- Le puede decir al despacher que eventos quieres escuchar
- Implementa la interfaz `EventSubscriberInterface` 
- Puede decir por si mismo al dispacher que evento quiere escuchar
- Si el autoconfigure está habilitado se enruta solo



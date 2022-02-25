
const deleteElement = (id, name, rute,tipo) => {
       console.log(id,name,rute);
      const form = document.getElementById('form');
      const spans = document.querySelectorAll('.titulo');
      const tipoSpan = document.querySelectorAll('.tipo');
      console.log(id,name,rute);
      spans.forEach((span) => {
            span.innerText = name;
      });
      
       tipoSpan.forEach((span) => {
            span.innerText = tipo;
      });

      form.action = `https://informatica.ieszaidinvergeles.org:10028/laraveles/netflix/public/${rute}/${id}`;
};

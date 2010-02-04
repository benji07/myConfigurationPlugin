# Plugin de configuration

## Format du fichier de config

		[yml]
		blog:
		  post_per_page:
		    default: 6
		    type: text
		    options:
		      label: Nombre d'article par page
		
		
On doit définir une classe qui a partir d'un nom de champs et d'un type renvoie un objet contenant un widget et un validator configuré correctement à partir du tableau d'option.

Au niveau d'un champs, on doit pouvoir définir la liste des options que l'on peut définir (options obligatoire et options facultative), de la même manière qu'elle sont définir pour les widget et les validateurs.
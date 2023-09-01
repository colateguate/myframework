#!/bin/bash

# Obtén el nombre del proyecto del usuario
echo "**************************************************"
echo "**************************************************"
echo "*                               SET UP                                              *"
echo "**************************************************"
echo "**************************************************"

echo "Por favor, introduce el nombre de tu nuevo proyecto:"

read projectName

# Comprueba si se ha introducido el nombre del proyecto
if [ -z "$projectName" ]; then
  echo "ALERT!! --> El nombre del proyecto no puede estar vacío."
  exit 1
fi

# Actualizar todos los archivos que necesitan ser actualizados.
# Esto incluye cambiar 'my_framework' al nuevo nombre del proyecto en composer.json y archivos PHP.
if [[ "$OSTYPE" == "darwin"* ]]; then
  # macOS
  sed -i '' "s/my_framework/$projectName/g" composer.json
  find . -type f -name "*.php" -exec sed -i '' "s/my_framework/$projectName/g" {} +
else
  # suponemos Linux o similar
  sed -i "s/my_framework/$projectName/g" composer.json
  find . -type f -name "*.php" -exec sed -i "s/my_framework/$projectName/g" {} +
fi

# Renombrar directorios
mv my_framework "$projectName"

# Actualizar el autoload en composer.json
composer update
composer dump-autoload

# Mostrar un mensaje de éxito
echo "NIICE!! --> El proyecto ha sido renombrado a $projectName exitosamente."

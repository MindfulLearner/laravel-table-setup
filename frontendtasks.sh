#!/bin/bash
# Configura la tua organizzazione e repository
ORGANIZATION="project-bnb"
REPO="laravel-db-bnb"

# Funzione per creare una issue
create_issue() {
  # Creare issue per la visualizzazione
  local title="Sistemare DB"
  local description=$(cat <<EOF
    sistemare visivamente il DB secondo correzione
EOF
  )
  gh issue create --repo "$ORGANIZATION/$REPO" --title "$title" --body "$description"

  local title="relazioni DB"
  local description=$(cat <<EOF
    sistemare il DB secondo al nuovo diagramma, e modificare il readme
EOF
  )
  gh issue create --repo "$ORGANIZATION/$REPO" --title "$title" --body "$description"


}

# Menu per creare più issue
while true; do
  echo "Vuoi creare una nuova issue? (s/n)"
  read -r choice
  if [[ "$choice" == "s" ]]; then
    create_issue
  else
    echo "Uscita dallo script."
    break
  fi
done

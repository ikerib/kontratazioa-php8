# Enable Powerlevel10k instant prompt. Should stay close to the top of ~/.zshrc.
# Initialization code that may require console input (password prompts, [y/n]
# confirmations, etc.) must go above this block; everything else may go below.
if [[ -r "${XDG_CACHE_HOME:-$HOME/.cache}/p10k-instant-prompt-${(%):-%n}.zsh" ]]; then
  source "${XDG_CACHE_HOME:-$HOME/.cache}/p10k-instant-prompt-${(%):-%n}.zsh"
fi

export ZSH="/root/.oh-my-zsh"

ZSH_THEME="agnoster"

HIST_STAMPS="mm/dd/yyyy"

plugins=(git zsh-syntax-highlighting zsh-autosuggestions )

source $ZSH/oh-my-zsh.sh

#source ~/.oh-my-zsh/custom/themes/powerlevel10k/powerlevel10k.zsh-theme

# To customize prompt, run `p10k configure` or edit ~/.p10k.zsh.
[[ ! -f ~/.p10k.zsh ]] || source ~/.p10k.zsh

alias c="clear"
alias d="docker"
#alias l="ls -lah"
alias s="source ~/.zshrc"
alias cc="php bin/console cache:clear"
alias dc="docker-compose"
alias sf="php bin/console"
alias cdw="cd ~/docker/IntraCalendar"
alias cdp="cd ~/dev/python"
alias dcd="docker-compose down"
alias dcu="docker-compose up -d"
alias dce="docker-compose exec"
alias dcl="docker-compose logs -f"
alias zshconfig="vim ~/.zshrc"

alias ll='lsd -lh --group-dirs=first'
alias la='lsd -a --group-dirs=first'
alias l='lsd -alh --group-dirs=first'
alias lla='lsd -lha --group-dirs=first'
alias ls='lsd --group-dirs=first'

#s4vitar
alias puertos="nmap -p- --open -T5 -v -n"


export PATH=~/.npm-global/bin:$PATH

# FZF
[ -f ~/.fzf.zsh ] && source .fzf.zsh 

# Funtzioak
lso() {
ls -l | awk '{k=0;for(i=0;i<=8;i++)k+=((substr($1,i+2,1)~/[rwx]/) \
             *2^(8-i));if(k)printf("%0o ",k);print}'
}

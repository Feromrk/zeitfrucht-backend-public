#!/bin/bash

VOLUME="docker/mysql/volume"
BUILD=false
CONFIG=false
CLEAN=false

logo() {
    echo "                                   0OOO0K                 WX0O0          "         
    echo "                                 c''....,;lk             l:,'.':k        "         
    echo "                                o..:llllc;'.,o       o;'.';:c:..:K       "         
    echo "                                l.'lxxxxxxoc'.;o  d;..,:::;,'..;x        "         
    echo "                                d..:dxxxxxxxo,..''.';:;,..,c             "         
    echo "                                 c..:oddxxxxxc....;:,..:d                "         
    echo "                                  l..,codddddc'.':,.'c                   "         
    echo "                                    c'.',;:::,,;;,.,k                    "         
    echo "                            X0OkkOKN 0l,......;c,..ckO     KOkkO0X       "         
    echo "                           c,.....':lc,......',,.......,cl:'.....,c      "         
    echo "                        0:..';:::;,...,;:::;,'..',;:::;,...,;:::;'..:O   "    
    echo "                       0;..;ccccccc,':cccccc:,,;:cccccc:,,:ccccccc;..;0  "         
    echo "                       x..,ccccccc:,;ccccccc;';cccccccc;,:cccccccc:,..x  "         
    echo "                       k'.,cccccc:;,,ccccccc;';cccccccc;';cccccccc:,.'k  "         
    echo "                        l..';::::::,',:::c::;'',,::::c:;'';:::cc:;'..l   "         
    echo "                         x;..'',,,,;;;,,,,,,,;;;;,,,,,,,;;;,,,,''..;x    "         
    echo "                           k;..,::ccccc::,';cccccc:;,';ccccc:;'..;k      "         
    echo "                            x..,cccccccc:;';ccccccc:,,:cccccc:,..x       "         
    echo "                             c..,:cccc::;'':ccccc::,',:cccc::,..c        "         
    echo "                              o,..',,,,,,;;,,,,,,,,;;,,,,,,'..,o         "         
    echo "                                d;..,;:ccccc;',;::cccc::;'..;d           "         
    echo "                                 o..;ccccccc;';cccccccc::,..o            "         
    echo "                                 k,.':cccccc:',;:ccccc::;'.,O            "         
    echo "                                  k,..,;;;;;,,,,,,;;:;;,..;k             "         
    echo "                                    d:'..,;;;:cc:;,,'...:d               "         
    echo "                                      c..;ccccccccc:;..c                 "         
    echo "                                      d..,cccccccc::,..d                 "         
    echo "                                       c..,;::::::;'..l                  "         
    echo "                                        x;...''''...;x                   "         
    echo "                                          Odlccccld                      "         
    echo "                                                                         "  
    echo " /\$\$\$\$\$\$\$\$           /\$\$   /\$\$      /\$\$\$\$\$\$                              /\$\$         /\$\$    "
    echo "|_____ \$\$           |__/  | \$\$     /\$\$__  \$\$                            | \$\$        | \$\$    "
    echo "     /\$\$/   /\$\$\$\$\$\$  /\$\$ /\$\$\$\$\$\$  | \$\$  \__//\$\$\$\$\$\$  /\$\$   /\$\$  /\$\$\$\$\$\$\$| \$\$\$\$\$\$\$  /\$\$\$\$\$\$  "
    echo "    /\$\$/   /\$\$__  \$\$| \$\$|_  \$\$_/  | \$\$\$\$   /\$\$__  \$\$| \$\$  | \$\$ /\$\$_____/| \$\$__  \$\$|_  \$\$_/  "
    echo "   /\$\$/   | \$\$\$\$\$\$\$\$| \$\$  | \$\$    | \$\$_/  | \$\$  \__/| \$\$  | \$\$| \$\$      | \$\$  \ \$\$  | \$\$    "
    echo "  /\$\$/    | \$\$_____/| \$\$  | \$\$ /\$\$| \$\$    | \$\$      | \$\$  | \$\$| \$\$      | \$\$  | \$\$  | \$\$ /\$\$"
    echo " /\$\$\$\$\$\$\$\$|  \$\$\$\$\$\$\$| \$\$  |  \$\$\$\$/| \$\$    | \$\$      |  \$\$\$\$\$\$/|  \$\$\$\$\$\$\$| \$\$  | \$\$  |  \$\$\$\$/"
    echo "|________/ \_______/|__/   \___/  |__/    |__/       \______/  \_______/|__/  |__/   \___/  "
}

#pretty output
put() {
    echo 
    echo ------------------------------------------------------------
    echo -e "$@"
    echo ------------------------------------------------------------
    echo 
}

logo

#parse arguments
while test $# -gt 0; do
        case "$1" in
                -h|--help)
                        echo "$(basename "$0")" "[options]"
                        echo 
                        echo "options:"
                        echo "-h, --help         show brief help"
                        echo "-b, --build        build / rebuild before run"
                        echo "-c, --config       only show config"
                        echo "-d, --clean        cleanup volumes"
                        exit 0
                        ;;
                -b|--build)
                        BUILD=true
                        shift
                        ;;
                -c|--config)
                        CONFIG=true
                        shift
                        ;;
                -d|--clean)
                        CLEAN=true
                        shift
                        ;;
                *)
                        echo -e "unknown flag \"$1\" provided, check -h or --help" 1>&2;
                        exit 1
                        ;;
        esac
done

export USERID=$(id -u)
export GROUPID=$(id -g)

if [ ! -d  "$VOLUME" ]; then
    put "creating volume $VOLUME"
    mkdir -v "$VOLUME"
    chmod -v -R 774 "$VOLUME"
fi

if [ "$BUILD" = true ]; then  
	CMD="docker-compose build"
	put "running $CMD"
	eval "$CMD"
elif [ "$CONFIG" = true ]; then  
	CMD="docker-compose config"
	put "running $CMD"
	eval "$CMD"
elif [ "$CLEAN" = true ]; then  
        put "cleaning up"
	rm -v -r "$VOLUME"
else
	CMD="docker-compose up"
	put "running $CMD"
	eval "$CMD"
fi

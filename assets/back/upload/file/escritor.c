#include <stdio.h>
#include <string.h>

char letra (char letra);

int main()
{
		long int i=1,j,n;
		
		char cadena[5005];
		
		scanf("%ld",&n);
		while(i<=n)
		{
			getchar();
			scanf("%[^\n]s ",cadena);
			getchar();
			for(j=0;j<strlen(cadena);j++)
			{
					cadena[j]=letra(cadena[j]);
			}
			if(i==n)
			{
				printf("%s",cadena);	
			}
			else
			{
				printf("%s\n\n",cadena);
			}
			i++;
		}
		printf("\n");
		return 0;
}

char letra (char letra)
{
	char a=letra;
	
	switch(letra)
	{
		case 'A':a='L';break;
		case 'a':a='l';break;
		case 'B':a='V';break;
		case 'b':a='v';break;
		case 'C':a='X';break;
		case 'c':a='x';break;
		case 'D':a='S';break;
		case 'd':a='s';break;
		case 'E':a='W';break;
		case 'e':a='w';break;
		case 'F':a='D';break;
		case 'f':a='d';break;
		case 'G':a='F';break;
		case 'g':a='f';break;
		case 'H':a='G';break;
		case 'h':a='g';break;
		case 'I':a='U';break;
		case 'i':a='u';break;
		case 'J':a='H';break;
		case 'j':a='h';break;
		case 'K':a='J';break;
		case 'k':a='j';break;
		case 'L':a='K';break;
		case 'l':a='k';break;
		case 'M':a='N';break;
		case 'm':a='n';break;
		case 'N':a='B';break;
		case 'n':a='b';break;
		case 'O':a='I';break;
		case 'o':a='i';break;
		case 'P':a='O';break;
		case 'p':a='o';break;
		case 'Q':a='P';break;
		case 'q':a='p';break;
		case 'R':a='E';break;
		case 'r':a='e';break;
		case 'S':a='A';break;
		case 's':a='a';break;
		case 'T':a='R';break;
		case 't':a='r';break;
		case 'U':a='Y';break;
		case 'u':a='y';break;
		case 'V':a='C';break;
		case 'v':a='c';break;
		case 'W':a='Q';break;
		case 'w':a='q';break;
		case 'X':a='Z';break;
		case 'x':a='z';break;
		case 'Y':a='T';break;
		case 'y':a='t';break;
		case 'Z':a='M';break;
		case 'z':a='m';break;
	}
	
	return a;
}

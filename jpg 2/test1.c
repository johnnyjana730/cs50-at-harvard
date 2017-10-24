#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <cs50.h>
#include <ctype.h>



int main()
{
    FILE* file = fopen("card.raw", "r"); 
    
    if (file == NULL)
    {
        printf("Could not open");
        return 2;
    }
    char *outfile;
    
    for(int i=0; i < 8; i++)
    {
///////////jpg name////////////
      if(i<9)
     outfile = "00%d" ,i; 
      
      printf("%s ",outfile);
    }
    
    
}
    
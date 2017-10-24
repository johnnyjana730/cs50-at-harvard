/**
 * recover.c
 *
 * Computer Science 50
 * Problem Set 4
 *
 * Recovers JPEGs from a forensic image.
 */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <cs50.h>
#include <ctype.h>

#include "jpg.h"
 
int main()
{
    FILE* inptr = fopen("card.raw", "r"); 
    
    if (inptr == NULL)
    {
        printf("Could not open\n");
        return 2;
    }
    
 ///////////jpg name////////////
  
    char outfile[80]="001.jpg"; 
///////////////// open output file//////

    FILE* outptr = fopen(outfile, "w");
    
    
    for(int i=0; i >= 0 ;i++)
    {

    // read infile's JPGPACK
    JPGPACK bf;
    fread(&bf, sizeof(JPGPACK), 1, inptr);
     
    ////////////// ensure jpg pack
     if (bf.jpg1 == (char)0xff && bf.jpg2 == (char)0xd8 && bf.jpg3 == (char)0xff)
    {  
           fwrite(&bf, sizeof(JPGPACK), 1, outptr);
         break;
    }
    }
    
    int n = 2;
 
     
  for(int i=0; i < 1000000  ;i++)
     {  
    // read infile's JPGPACK
    JPGPACK bf;
    fread(&bf, sizeof(JPGPACK), 1, inptr);  
    
    
        if (bf.jpg1 == (char)0xff && bf.jpg2 == (char)0xd8 && bf.jpg3 == (char)0xff)
      {
        fclose(outptr);
        
        sprintf(outfile,"0%d.jpg",n); 
        n++; 
        
        outptr = fopen(outfile, "w");
        
      }  
    fwrite(&bf, sizeof(JPGPACK), 1, outptr);
      }          

    // close infile
    fclose(inptr);
    // that's all folks
    return 0;
    
}

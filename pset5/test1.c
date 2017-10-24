
#include <stdlib.h>
#include <string.h>
#include <cs50.h>
#include <ctype.h>
#include <stdio.h>


// default dictionary
#define DICTIONARY "dictionaries/large"

// maximum length for a word
// (e.g., pneumonoultramicroscopicsilicovolcanoconiosis)
#define LENGTH 45

 
typedef struct node
{
         char word;
         struct node* next[26];
         int wordlength;
}node;


int 
main
(int argc, char* argv[])
{   
///////////////search inputword   

    int wordinlengh = strlen(argv[1]);
    if (wordinlengh > 45)
    { 
        printf("Word inputed is larger than 45");
        return 1;
    }
    
    char wordin[46];
    sprintf(wordin, "%s" ,argv[1]);
    
////////////////////////////////////////////    
     FILE* inptr = fopen(DICTIONARY, "r"); 
    
    node Head;
    for(int i = 0; i < 26; i++)
    Head.next[i] = NULL;
    node *tmp;
    node *current = &Head;
//////////////previous character////////////// 
   int k= 0;
     // prepare to spell-check//////////////
    int index = 0;
    
     // spell-check each word in text
    for (int c = fgetc(inptr); c != EOF; c = fgetc(inptr))
    {   
        
        // allow only alphabetical characters and apostrophes
        if (isalpha(c) || (c == '\'' && index > 0))
        {     
        
            if ( current->next[c-97] == NULL)
         {      current->next[c-97] = malloc(sizeof(node));
                for(int i = 0; i < 26; i++)
                current->next[c-97]->next[i] = NULL;
                current->next[c-97]->word = c;
                                 // we must have found a whole word
                tmp  = current->next[c-97];
                current = tmp; 
         }
           else 
            {  
                tmp  = current->next[c-97];
                current = tmp; 
            }
        }
          if (index > 0)
              { if (c == 10)
              
               { 
                  current->wordlength = index;
                  index = -1;
                  node *tep = &Head;
                  current = tep;

               }
               
              }      
          
        index++;
        k++;
     }


/////////// x for in character/////    
    int x = wordin[0];
    node* cursor = Head.next[x-97];
    
//////////////search liberary//////  
    for (int i = 1; i<=strlen(argv[1]); i++)
   {   
    {    
           if(cursor-> wordlength == wordinlengh)
         { 
            printf("find in dictionary");
            break;
         } 
            x = wordin[i];
            cursor = cursor->next[x-97];
            
           if(cursor == NULL)
         {
           printf("The word isn't in dictionary");
          break;
         }   
    }
          
   }  
         
    
    return 0;
}


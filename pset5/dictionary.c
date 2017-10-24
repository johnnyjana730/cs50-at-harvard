/**
 * dictionary.c
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Implements a dictionary's functionality.
 */

#include <stdlib.h>
#include <string.h>
#include <cs50.h>
#include <ctype.h>
#include <stdio.h>

#include "dictionary.h"



/**
 * Returns true if word is in dictionary else false.
 */
 
bool check(const char* word , struct node *Head) 
{   
   
    node root = *Head;
/////////// x for in character/////    
     bool a = false;
    int x = word[0];
    if (x<97)
    {
        x=x+32;
    }
    node* cursor = root.next[x-97];
    int wordinlengh = strlen(word);
//////////////search liberary//////  
    for (int i = 1; i<= wordinlengh; i++)
   {       
         if(cursor == NULL)
         { a = false;
            break;
         }   
          
         else if (cursor-> wordlength == wordinlengh)
         { 
            a =true;
            break;
         } 
            x = word[i];
            if (x<97)
            {
                x=x+32;
            }
            if (x==71)
            x=123;
            cursor = cursor->next[x-97];
    }
    
 
    return a;
 }


//////////////////////////



bool fload(const char* dictionary,struct node *Head, int *k)
{  int temp = *k;
 ////////////////////////////////////////////    
    FILE* inptr = fopen(dictionary, "r"); 
    
    for(int i = 0; i < 27; i++)
    Head->next[i] = NULL;
    node *tmp;
    node *current = Head;

     // prepare to spell-check//////////////
    int index = 0;
    
     // spell-check each word in text
    for (int c = fgetc(inptr); c != EOF; c = fgetc(inptr))
    {   
        
        // allow only alphabetical characters and apostrophes
        if (isalpha(c) || (c == '\'' && index > 0)||c==39)
        {    if (c==39)
              c=123;
                
            if ( current->next[c-97] == NULL)
            { current->next[c-97] = malloc(sizeof(node));
                for(int i = 0; i < 27; i++)
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
                  node *tep = Head;
                  current = tep;
                  temp++;
               }
               
              }      
         *k =temp;
        index++;
       
    }
    return true;
}

/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(int *k)
{    int a = *k;
    return a;
}

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(struct node* node)
{   
    return true;
}
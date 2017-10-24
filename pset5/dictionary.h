/**
 * dictionary.h
 *
 * Computer Science 50
 * Problem Set 5
 *
 * Declares a dictionary's functionality.
 */

#ifndef DICTIONARY_H
#define DICTIONARY_H

#include <stdbool.h>

// maximum length for a word
// (e.g., pneumonoultramicroscopicsilicovolcanoconiosis)
#define LENGTH 45

typedef struct node
{
         char word;
         struct node* next[27];
         int wordlength;
}node;

/**
 * Returns true if word is in dictionary else false.
 */
bool check(const char* word, struct node*);
/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
/**
 * Loads dictionary into memory.  Returns true if successful else false.
 */
bool fload(const char* dictionary, struct node*, int *k );
/**
 * Returns number of words in dictionary if loaded else 0 if not yet loaded.
 */
unsigned int size(int *k);

/**
 * Unloads dictionary from memory.  Returns true if successful else false.
 */
bool unload(struct node*);

#endif // DICTIONARY_H

void free_all(struct node *);
#include <stdint.h>

typedef char  BYTE;
typedef uint32_t DWORD;
typedef int32_t  LONG;
typedef uint16_t WORD;


typedef struct 
{ 
    BYTE   jpg1; 
    BYTE   jpg2; 
    BYTE   jpg3; 
    BYTE   jpg4;
    LONG   jpg[127];
} __attribute__((__packed__)) 
JPGPACK; 

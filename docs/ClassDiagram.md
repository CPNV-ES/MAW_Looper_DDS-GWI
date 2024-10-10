[Diagram direct access](https://www.plantuml.com/plantuml/png/jLLDJzj04BtlhvYZeyOeq9ugGAH9g2nHYWgYXxP26tiIN3Qxrkwu9Gtyzwu_7CPrGgEgS5ZCVBnvE_E6FN4aBUKB9OIxItKchLn0hAHpGoARJdF2A3RwCls5C10Ya_6Td2CCi-ph1vEWMWa105K6Z2N9gNIu4b3_X71h7C5RS1vCpvazCtQZFPcUomLkykGEhTxYotpvdyOcNTyhSAWmfi1JKq-vVOYDoXVQUSkNRtsOfOhGEZZoVtcJj5OkYvXSaxSDl2dLr0SpcpbiMso2zjsoJlH7hpnP_LHxujtwFwJAqQrJfiOeU839VOmPfKOpW3nB9E5p00LJdQH5taw82Ihi8Eu8mYOrCbfZN9Y38lPY_B5qFt9DdAQeaXLlHrArpgFgN2dcQGstwwPbvjqLu9N_xaRWFTeuTHXjAH52-yRCqQYXSRKcU7WO6-tjUKp67XzN58BrHOxAAlqs_yPQqex-3ELCcQF7YiwHoZeks1RSDCDpxQO5i-9iKdfrA0kCBKh2AhR5d5DEkbJNPU6XL4T7Lftod35BOTh-2mjDd4PZsQb220xfkjoKW6zSLwXhNUqcLag9AUb5bLQGwggjJM2pWCfCtiSUNw1_QDAadi9_MMX7ad8NRKql1-oULFvIJMukjUD6SzvCUPtLQkkPAPCDg2dzt8utCJkFwx7zJe-CnTOpNJ_S_3-v1sWUx-sDgXA3favnCjIHqMIDKcXNZ4YP0c7u15yEqriUQZonrYCtDfVcDcuqbIXgjBqzjYf226q8GJguiEOxnYJgt_wMPyPaQCLLlJpN-pUZWlqubNCh5pUrUvZJhR6kw4fgvWR6GxYCpgw7S3hvT3uy7qyk-_0UpMncpT93qgsqy3aw6qV2NxF07RmEzmVXmU3WZK2TGC57Y1F_cI_KRm00)

Code for it (use it on [PlantUML website](https://www.plantuml.com/plantuml/uml/SyfFKj2rKt3CoKnELR1Io4ZDoSa70000):
```md
@startuml

skinparam classAttributeIconSize 0

package App\Model{

    class Database{
        - host : string
        - port : string
        - dbName : string
        - username : string
        - password : string
        + select(table : string, columns : [], filters = [] : array, count = 0 : int, offset = 0 : int, orderBy = [] : []) : []
        + insert(table : string, values : []) : bool | Exception
        + update(table : string, values : [], conditions : []) : bool | Exception
        + delete(table : string, conditions : []) : bool | Exception
        - dbConnection() : PDO
    }

    class Field{
        + id : int | null
        + name : string | null
        + type : FieldType | null
        + exerciseId : int | null
        - table : string
        - columns : string[]
        + <<constructor>> Field(id : int = null, name : string = null, typeId : int = null, exerciseId : int = null)
        + getFields(exerciseId : int = null) : Field[]
        + getField(fieldId : int): Field
        + createField(name : string, typeId : id, exerciseId : int) : Field | bool
        + deleteField(fieldId : int = null) : bool
        + updateField(name : string, typeId : int, exerciseId : int, fieldId : int = null) : bool
        - setValues(values : [])
    }

    class FieldType{
        + id : int | null
        + title : string | null
        - table : string
        - columns : string[]
        + <<constructor>> FieldType(id : int = null, title : string = null)
        + getType(typeId : int) : FieldType
        - setValues(values : [])
    }

    class Exercise{
        + id : int | null
        + name : string | null
        + statusId : int | null
        + fields : Field[] | null
        - table : string
        - columns : string[]
        + <<constructor>> Exercise(id : int = null, name : string = null, statusId : int = null)
        + create(name : string) : bool
        + getExercise(exerciseId : int = null) : Exercise
        - setValues(values : [])
    }

}

package App\Core{

    class Model{
        - db : Database
        + <<constructor>> Model()
    }
    
    class Controller{
    }

}

Model -- Database
Field --|> Model
FieldType --|> Model
Exercise --|> Model

Exercise --o Field
Field ..> FieldType


note as Project
Project : Looper
Title : V1_ClassDiagram_Looper
Authors : Diogo DA SILVA FERNANDES, Geoffroy Lothar WILDI
Date : 03-10-2024
end note

@enduml
```
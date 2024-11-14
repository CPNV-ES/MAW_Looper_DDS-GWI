[Diagram direct access](http://www.plantuml.com/plantuml/duml/jLRVJzj847xtNp6FZYv6WRkd4o124awHE8eQIX_Q2ctiIN3Px5gxQqgQyBztxVM6SHrJgw9zSCty-EQRdMysFjE6APElUA0VKf4nnLOGSwRrq1YLpdE3qrYAMVeTOH046OiVs19Xc6MV_vS9yaqG083BW34pRCuqRWAe_aLmBxM1Vq5RCB4azaoglVPaViLMkC-JQrIYnPVPyj-aIfg-lq0ZnzY4bXf_oUr3B7c-4jfQFdtfmoBb1fM64_kNDJ6bsBg8oOMnje4rfSBqGIuM6kiMbQ0wNrU9zj4hdwH-AYpnPlr7ndFKkvIvb1osC7cACJEf50GWpn9cy3M0Wgb8qYAl4sA271k8tK7yf4PI28mBSrZ4Ne_VbUvdgecB57coeSUHkAEpg2Bdd7XgmsswpJgpRWTuOz-R4VY4AaurJbjAH53lc3Yy6hohDi7ZurWAQyzZ8zNfgQCGxXevAQlqw_ozjQGz_JcKCYME7YcwH5FMqM5Ri3yCoxMP5YwAfq_fLQ4aC5R83BhO6dDAEMbItPM5RQcEXgoQvIbZdqAr_IiMmb0QtjAfGWGQpMsvAI7TkAPGTxhg9bQJ6gAaFwOqJwgfjZg1_G8gC-avzkW2_SOXJQeflCb2QyDChgTjwMx0-aNbRGWsOkPUtcGAaRlJ7MItCVbZwNedaCw9TXlBMT-8NXNjruuEsXDuzRBmGR1rlsy4Wd7ZExOz-40lcVrxtWpik7ls-IZJnAkBoCinU9i5zDhmlROEpnNjlc2qkmzPIDeX0wb0UqIRdaWpx7nzKzGYqTNPFDU_k4PIOUs3g_e4ex_95i9_XhNtx193l-35aw2Ef31ASevgKmKKHCeKYA8N-78jhMLRuGMxcuKQlKQepJL9BJHCkeMly0yEo3LerIAaGM0QhfNyYh49glzjtvTIPgY2csfkjuTtewAVSSgMYgtkAlSmD_TIwUASKhcKC1x2R7fvEuIBoVkhuTLuCkl3VoWN2oNN5jBSCmKVfvVZQM0RBt07VqU7W-XeSFHFW2A1WazmPj_o5Vy1)
Code for it (use it on [PlantUML website](http://www.plantuml.com/plantuml/uml/)
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
        + status : Status | null
        - table : string
        - columns : string[]
        - orderStatus : string[]
        + <<constructor>> Exercise(id : int = null, name : string = null, statusId : int = null)
        + create(name : string) : int | bool
        + getExercises(exerciseId : int = null) : Exercise | array
        + alterStatus(idExercise: int) : bool
        + delete(idExercise: int) : bool
        - setValues(values : []) : void
    }


    class Status{
        + id : int | null
        + title : string | null
        - status : array
        + <<constructor>> Status(id : int = null, title : string = null)
        - setUp() : void
        + getStatus() : Status | array
        + getStatusByTitle() : Status
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
Status --|> Model

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
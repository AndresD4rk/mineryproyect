from genderize import Genderize

def verificar_genero(nombre):
    resultado = Genderize().get([nombre])
    genero = resultado[0]['gender']
    probabilidad = resultado[0]['probability']

    if genero == 'male' and probabilidad >= 0.8:
        return 'masculino'
    elif genero == 'female' and probabilidad >= 0.8:
        return 'femenino'
    elif genero is None or probabilidad < 0.8:
        return 'indeterminado'
    else:
        return 'ambiguo'

# Ejemplos de uso
nombre1 = 'Andres'
genero1 = verificar_genero(nombre1)
print(f"El nombre {nombre1} es {genero1}")

nombre2 = 'Luis'
genero2 = verificar_genero(nombre2)
print(f"El nombre {nombre2} es {genero2}")

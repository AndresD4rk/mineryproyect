import csv

def repetir_datos_csv(dato1, n, dato2, m, archivo_csv):
    datos_repetidos = [(dato1,) * n, (dato2,) * m]
    max_reps = max(n, m)

    with open(archivo_csv, 'w', newline='') as archivo:
        writer = csv.writer(archivo)
        writer.writerow(['Dato1', 'Dato2'])  # Escribir encabezados en el archivo CSV
        writer.writerows(zip(*datos_repetidos))

    print(f"Se han generado {max_reps} filas con el dato {dato1} repetido {n} veces y el dato {dato2} repetido {m} veces en el archivo {archivo_csv}.")

# Ejemplo de uso
dato1 = 'F'
n = 197777
dato2 = 'M'
m = 111908
archivo_csv = 'datos.csv'

repetir_datos_csv(dato1, n, dato2, m, archivo_csv)

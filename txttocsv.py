import csv
import tkinter as tk
from tkinter import filedialog

def convertir_txt_a_csv():
    # Seleccionar el archivo de texto a convertir
    archivo_txt = filedialog.askopenfilename(filetypes=[("Archivos de texto", "*.txt")])

    if not archivo_txt:
        return

    # Definir el nombre del archivo CSV resultante
    archivo_csv = archivo_txt.rsplit(".", 1)[0] + ".csv"

    # Abrir el archivo de texto y el archivo CSV
    with open(archivo_txt, "r") as archivo_entrada, open(archivo_csv, "w", newline="") as archivo_salida:
        # Crear el escritor CSV
        escritor_csv = csv.writer(archivo_salida)

        # Leer líneas del archivo de texto y escribirlas en el archivo CSV
        for linea in archivo_entrada:
            # Eliminar saltos de línea y dividir la línea en campos
            campos = linea.strip().split("    ")

            # Eliminar campos vacíos
            campos = [campo for campo in campos if campo]

            # Escribir la fila en el archivo CSV
            escritor_csv.writerow(campos)

    # Mostrar un mensaje de éxito
    mensaje_label.config(text="La conversión se ha completado con éxito.")

# Crear la ventana principal
ventana = tk.Tk()
ventana.title("Conversor TXT a CSV")

# Botón para seleccionar el archivo y realizar la conversión
boton_convertir = tk.Button(ventana, text="Seleccionar archivo TXT", command=convertir_txt_a_csv)
boton_convertir.pack(pady=20)

# Label para mostrar mensajes de éxito
mensaje_label = tk.Label(ventana, text="")
mensaje_label.pack()

# Iniciar la aplicación
ventana.mainloop()

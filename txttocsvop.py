import csv
import tkinter as tk
from tkinter import filedialog
from tkinter import ttk

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
ventana.geometry("400x200")
ventana.configure(bg="#F1E8E6")

# Estilo elegante
style = ttk.Style()
style.configure("TButton",
                padding=6,
                font=("Arial", 12),
                foreground="#FFFFFF",
                background="#0080FF")
style.configure("TLabel",
                font=("Arial", 12),
                foreground="#000000",
                background="#F1E8E6")

# Marco para los elementos de la interfaz
marco = ttk.Frame(ventana, padding=20)
marco.pack()

# Botón para seleccionar el archivo y realizar la conversión
boton_convertir = ttk.Button(marco, text="Seleccionar archivo TXT", command=convertir_txt_a_csv)
boton_convertir.pack(pady=10)

# Label para mostrar mensajes de éxito
mensaje_label = ttk.Label(ventana, text="", padding=20)
mensaje_label.pack()

# Iniciar la aplicación
ventana.mainloop()

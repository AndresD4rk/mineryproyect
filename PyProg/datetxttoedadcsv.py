import csv
from datetime import datetime
import tkinter as tk
from tkinter import filedialog, messagebox

def calcular_edad(fecha_nacimiento):
    fecha_actual = datetime.now()
    edad = fecha_actual.year - fecha_nacimiento.year
    if (fecha_actual.month, fecha_actual.day) < (fecha_nacimiento.month, fecha_nacimiento.day):
        edad -= 1
    return edad

def procesar_archivo():
    ruta_archivo = filedialog.askopenfilename(title="Seleccionar archivo de texto", filetypes=[("Archivos de texto", "*.txt")])
    if not ruta_archivo:
        return
    
    ruta_salida = filedialog.asksaveasfilename(title="Guardar archivo CSV", defaultextension=".csv", filetypes=[("Archivos CSV", "*.csv")])
    if not ruta_salida:
        return
    
    try:
        with open(ruta_archivo, 'r') as archivo:
            lineas = archivo.readlines()
        
        encabezados = lineas[0].strip().split(',')
        datos_procesados = []
        
        for linea in lineas[1:]:
            campos = linea.strip().split(',')
            fecha_nacimiento = datetime.strptime(campos[0], '%d/%m/%Y')
            edad = calcular_edad(fecha_nacimiento)
            datos_procesados.append([edad] + campos)
        
        with open(ruta_salida, 'w', newline='') as archivo_csv:
            escritor_csv = csv.writer(archivo_csv)
            escritor_csv.writerow(['Edad'] + encabezados)
            escritor_csv.writerows(datos_procesados)
        
        messagebox.showinfo("Proceso completado", "Los datos se han guardado en {}".format(ruta_salida))
    except Exception as e:
        messagebox.showerror("Error", str(e))

# Crear la ventana principal
ventana = tk.Tk()
ventana.title("Conversión de fechas a edades")
ventana.geometry("400x200")

# Crear un botón para seleccionar el archivo
boton_seleccionar = tk.Button(ventana, text="Seleccionar archivo", command=procesar_archivo)
boton_seleccionar.pack(pady=20)

# Ejecutar el bucle de eventos de la ventana
ventana.mainloop()

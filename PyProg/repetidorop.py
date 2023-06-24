import csv
import tkinter as tk
from tkinter import messagebox, filedialog

def exportar_a_csv(valores):
    guardar_path = filedialog.asksaveasfilename(defaultextension=".csv")
    if guardar_path:
        with open(guardar_path, 'w', newline='') as archivo_csv:
            writer = csv.writer(archivo_csv)
            writer.writerow(["Valor"])
            for valor, repeticiones in valores.items():
                for _ in range(repeticiones):
                    writer.writerow([valor])
        messagebox.showinfo("Exportación exitosa", "Los valores se han exportado correctamente.")

def agregar_valor():
    valor = valor_entry.get().strip()
    repeticiones = repeticiones_entry.get().strip()
    
    if valor and repeticiones:
        try:
            repeticiones = int(repeticiones)
            if repeticiones < 1:
                raise ValueError
            valores[valor] = repeticiones
            valores_listbox.insert(tk.END, f"{valor}: {repeticiones}")
            valor_entry.delete(0, tk.END)
            repeticiones_entry.delete(0, tk.END)
        except ValueError:
            messagebox.showerror("Error", "La cantidad de repeticiones debe ser un número entero mayor o igual a 1.")
    else:
        messagebox.showerror("Error", "Por favor, ingresa un valor y la cantidad de repeticiones.")

def eliminar_valor():
    seleccion = valores_listbox.curselection()
    if seleccion:
        indice = seleccion[0]
        valor = valores_listbox.get(indice).split(":")[0].strip()
        del valores[valor]
        valores_listbox.delete(indice)
    else:
        messagebox.showerror("Error", "Por favor, selecciona un valor de la lista para eliminar.")

# Crear la ventana principal
ventana = tk.Tk()
ventana.title("Exportador CSV")
ventana.geometry("400x400")

# Marco para los elementos de la interfaz
marco = tk.Frame(ventana)
marco.pack(pady=10)

# Etiqueta y campo de entrada para el valor
valor_label = tk.Label(marco, text="Valor:")
valor_label.grid(row=0, column=0, sticky="w")

valor_entry = tk.Entry(marco, width=30)
valor_entry.grid(row=0, column=1, padx=10)

# Etiqueta y campo de entrada para las repeticiones
repeticiones_label = tk.Label(marco, text="Repeticiones:")
repeticiones_label.grid(row=1, column=0, sticky="w")

repeticiones_entry = tk.Entry(marco, width=30)
repeticiones_entry.grid(row=1, column=1, padx=10)

# Botón para agregar un valor
agregar_boton = tk.Button(ventana, text="Agregar", command=agregar_valor)
agregar_boton.pack(pady=5)

# Lista de valores agregados
valores_listbox = tk.Listbox(ventana, width=40)
valores_listbox.pack(pady=10)

# Botón para eliminar un valor seleccionado
eliminar_boton = tk.Button(ventana, text="Eliminar", command=eliminar_valor)
eliminar_boton.pack(pady=5)

# Botón para exportar a CSV
exportar_boton = tk.Button(ventana, text="Exportar a CSV", command=lambda: exportar_a_csv(valores))
exportar_boton.pack(pady=10)

# Diccionario para almacenar los valores y sus repeticiones
valores = {}

# Iniciar el programa
ventana.mainloop()

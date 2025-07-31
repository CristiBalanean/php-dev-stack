# PHP CSV Dev Stack

A collection of CLI tools for processing CSV files: joining, merging, reordering, encrypting, signing, and more.

---

## Usage

All commands are run through the main dispatcher:

```sh
php run.php <command> [arguments...]
```

---

## Commands

### 1. `prepend-header`
**Prepends a new header to a CSV file.**

```sh
php run.php prepend-header input.csv output.csv "col1,col2,col3"
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file  
- `"col1,col2,col3"`: Comma-separated header columns

---

### 2. `index-colums`
**Adds an index column to the CSV file.**

```sh
php run.php index-colums input.csv output.csv
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file

---

### 3. `remove-column`
**Removes a column by name.**

```sh
php run.php remove-column input.csv output.csv columnName
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file  
- `columnName`: Name of the column to remove

---

### 4. `reorder-columns`
**Reorders columns according to the specified header.**

```sh
php run.php reorder-columns input.csv output.csv "col3,col1,col2"
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file  
- `"col3,col1,col2"`: New column order

---

### 5. `truncate-string`
**Truncates the values in a column to a specified length.**

```sh
php run.php truncate-string input.csv output.csv columnName length
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file  
- `columnName`: Column to truncate  
- `length`: Maximum length

---

### 6. `merge-files`
**Merges multiple CSV files into one.**

```sh
php run.php merge-files output.csv input1.csv input2.csv [input3.csv ...]
```
- `output.csv`: Output CSV file  
- `input1.csv`, `input2.csv`, ...: Input CSV files to merge

---

### 7. `encrypt-files`
**Encrypts specified columns using a public key.**

```sh
php run.php encrypt-files input.csv output.csv "col1,col2" public.pem
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file  
- `"col1,col2"`: Comma-separated columns to encrypt  
- `public.pem`: Path to public key file

---

### 8. `decrypt-files`
**Decrypts specified columns using a private key.**

```sh
php run.php decrypt-files input.csv output.csv "col1,col2" private.pem
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file  
- `"col1,col2"`: Comma-separated columns to decrypt  
- `private.pem`: Path to private key file

---

### 9. `sign-column`
**Signs a column using a private key and adds the signature as a new column.**

```sh
php run.php sign-column input.csv output.csv columnName private.pem signatureColumn
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file  
- `columnName`: Column to sign  
- `private.pem`: Path to private key file  
- `signatureColumn`: Name for the signature column

---

### 10. `verify-signature`
**Verifies a signature column using a public key and adds the result as a new column.**

```sh
php run.php verify-signature input.csv output.csv columnName signatureColumn public.pem resultColumn
```
- `input.csv`: Source CSV file  
- `output.csv`: Output CSV file  
- `columnName`: Column to verify  
- `signatureColumn`: Column containing the signature  
- `public.pem`: Path to public key file  
- `resultColumn`: Name for the verification result column

---

### 11. `inner-join`
**Performs an inner join between two CSV files on specified columns.**

```sh
php run.php inner-join left.csv right.csv output.csv leftKey rightKey
```
- `left.csv`: Left CSV file  
- `right.csv`: Right CSV file  
- `output.csv`: Output CSV file  
- `leftKey`: Join column in the left file  
- `rightKey`: Join column in the right file

---

## Notes

- All commands require PHP and the dependencies installed via Composer.
- Column names are case-sensitive.
- For commands that take a list of columns, use a comma-separated string (no spaces).

---
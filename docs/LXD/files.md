Helper methods for files.

## List

List files and directories in a container.

**Note:** Does not work for listing *file contents* unless your using LXD > 3.0.0, 
so should be used only to list directories, see pull method below on how to 
fetch them.


**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| container    | string        | Container name    |           |
| path         | string        | Container directory path | |
| mutator      | function      | Mutation function |           |

``` php
$client->lxd->containers->files->list('local', 'container-name', '/');
```

**Response**
``` json
[
    "proc",
    "usr",
    "run",
    "etc",
    "home",
    "sbin",
    "snap",
    "opt",
    "lib64",
    "boot",
    "root",
    "media",
    "lib",
    "sys",
    "bin",
    "mnt",
    "var",
    "tmp",
    "srv",
    "dev"
]
```

## Push

Upload files or folders into the container.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| container    | string        | Container name    |           |
| source       | string        | Local file/folder path |      |
| path         | string        | Container file path |         |

<em>
    Note: If both the *source* and the *path* parameters are folders, the method will
    recursively upload, otherwise it will set mode `755` if folder or `644` if file.
    All files are uploaded as uid/gid root user.
</em>

``` php
// single file
$client->lxd->containers->files->push('local', 'my-container', '/local/path/to/file.ext', '/path/to/file.ext');

// entire directory
$client->lxd->containers->files->push('local', 'my-container', '/local/path/to/folder', '/path/to/folder');
```

**Response**
``` json
""
```

## Pull

Download a file from the container.

**Note:** We use `lxc file pull` as there is a bug which prevents accessing the file with 
files endpoint though `lxc query`. Its fixed in LXD > 3.0.0, so will be converted 
to use that in future.

**Parameters & Call**

| Parameter    | Type          | Description   | Default       |
| ----------   | ------------- | ------------- | ------------- | 
| remote       | string        | LXD remote    | local         |
| container    | string        | Container name    |           |
| path         | string        | Container file path |

``` php
$client->lxd->containers->files->pull('local', 'my-container', '/path/to/file');
```

<em>
    Because with `file pull` you cant output to stdout, we need to pull the file then `cat` it,
    so a folder structure is created based upon the path.
</em>

<em>Example above would create: `./.files/local/my-container/path/to/file`</em>

**Response**
``` txt
The file contents
```
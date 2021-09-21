import { Button, makeStyles } from '@material-ui/core';
import { PropertySpec } from "services/Api/ParsedApiSpecInterface";
import CustomComponentWrapper from "./CustomComponentWrapper";
import BackupIcon from '@material-ui/icons/Backup';

interface ViewValueProps {
    columnName: string,
    property: PropertySpec,
    values: any,
    changeHandler: Function,
}

const FileUploader = (props: ViewValueProps) => {

    let { property, columnName, values, changeHandler } = props;

    const id = `${columnName}-file-upload`;
    const fileName = values[columnName]?.file
        ? values[columnName].file?.name
        : values[columnName].baseName;

    const fileSize = values[columnName]?.file
        ? values[columnName].file?.size
        : values[columnName].fileSize;

    const fileSizeMb = Math.round(fileSize / 1024 / 1024 * 10) / 10;

    const classes = useStyles();

    return (
        <CustomComponentWrapper property={property}>
            <div className={classes.container}>
                <input
                    className={classes.displayNone}
                    id={id}
                    type="file"
                    onChange={(event) => {

                        const files = event.target.files || [];
                        console.log('files', files);

                        const value = {
                            ...values[columnName],
                            ...{ file: files[0] }
                        };

                        changeHandler({
                            target: {
                                name: columnName,
                                value: value,
                            }
                        });
                    }}
                />
                <div>
                    <label htmlFor={id} className={classes.button}>
                        <Button variant="contained" color="primary" component="span">
                            <BackupIcon />
                        </Button>
                    </label>
                </div>
                {fileName && <div className={classes.fileName}>{fileName} ({fileSizeMb}MB)</div>}
            </div>
        </CustomComponentWrapper>
    );
}

const useStyles = makeStyles((theme: any) => ({
    container: {
        display: 'flex',
        flexDirection: 'row-reverse',
        alignItems: 'flex-end',
        justifyContent: 'space-between',
    },
    fileName: {
        alignItems: 'flex-start',
        flexGrow: 1,
        alignSelf: 'center',
    },
    button: {
        alignItems: 'flex-end',
        cursor: 'pointer',
    },
    displayNone: {
        display: 'none',
    }
}));

export default FileUploader;
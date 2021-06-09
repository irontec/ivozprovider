import React, { useState, MouseEvent, ChangeEvent } from 'react';
import {
    TextField, withStyles, Grid, Menu, MenuItem, IconButton
} from '@material-ui/core';
import Autocomplete from '@material-ui/lab/Autocomplete';
import FilterIconFactory from 'icons/FilterIconFactory';

const ContentFilterRow = function (props: any) {

    const {
        columnName,
        columnLabel,
        classes,
        rowNum,
        setFilter,
        filterTypes,
        choices
    } = props;

    let { values } = props;

    values = values || { type: '', value: '' };
    if (choices) {
        values.type = 'in';
    }

    const anchorRef = React.useRef(null);
    const [open, setOpen] = useState(false);

    const [filterType, setFilterType] = useState<string>(
        values.type
    );

    const handleFilterTypeCheck = (filterType: string) => {
        setFilterType(filterType);
        setOpen(false);

        if (values.value) {
            setFilter(
                columnName,
                filterType,
                values.value
            );
        }
    };

    const handleToggle = (event: MouseEvent<HTMLButtonElement>) => {
        setOpen(!open);
    };

    const handleClose = (event: any) => {
        setOpen(false);
    };

    const handleChange = (event: ChangeEvent<HTMLInputElement>) => {
        setFilterValue(
            event.target.value
        );
    }

    const setFilterValue = (value: any, label?: any) => {
        setFilter(
            columnName,
            filterType,
            value,
            label
        );
    }

    return (
        <Grid container={true} spacing={3} alignItems="flex-end" className={classes.grid}>
            <Grid item>
                {choices &&
                    <IconButton size='small'>
                        <FilterIconFactory name={filterType} />
                    </IconButton>
                }
                {!choices &&
                    <IconButton size='small' onClick={handleToggle} ref={anchorRef}>
                        <FilterIconFactory name={filterType} />
                    </IconButton>
                }
                <Menu
                    anchorEl={anchorRef.current}
                    open={open}
                    onClose={handleClose}
                    getContentAnchorEl={null}
                    anchorOrigin={{
                        vertical: 'top',
                        horizontal: 'right',
                    }}
                    transformOrigin={{
                        vertical: 'top',
                        horizontal: 'center',
                    }}
                >
                    {filterTypes.map((filter: any) => {
                        return (
                            <MenuItem
                                value={filter.value}
                                onClick={() => { handleFilterTypeCheck(filter.value) }}
                                key={filter.value}
                            >
                                <FilterIconFactory name={filter.value} className={classes.icon} />
                                <em>{filter.label}</em>
                            </MenuItem>
                        );
                    })}
                </Menu>
            </Grid>
            < Grid item>
                <div>
                    {choices &&
                        <Autocomplete
                            multiple
                            filterSelectedOptions
                            options={choices}
                            defaultValue={values.value}
                            getOptionLabel={option => option.label}
                            onChange={(event, newValue) => {

                                const values = newValue.reduce(
                                    (acc: Array<number>, value: any) => {
                                        acc.push(value.id);
                                        return acc;
                                    },
                                    []
                                );

                                const labels = newValue.reduce(
                                    (acc: Array<number>, value: any) => {
                                        acc.push(value.label);
                                        return acc;
                                    },
                                    []
                                );

                                setFilterValue(values, labels);
                            }}
                            style={{ minWidth: '200px' }}
                            renderInput={(params: any) => (
                                <TextField {...params} name={columnName} label={columnName} variant="outlined" fullWidth />
                            )}
                        />
                    }
                    {!choices &&
                        <TextField
                            name={columnName}
                            onChange={handleChange}
                            tabIndex={rowNum + 1}
                            label={columnLabel}
                            value={values.value}
                        />
                    }
                </div>
            </Grid >
        </Grid >
    );
}

const styles = {
    icon: {
        display: 'inline-flex',
        marginRight: '10px',
    },
    clickableIcon: {
        display: 'inline-flex',
        marginRight: '10px',
        cursor: 'pointer',
    },
    grid: {
        margin: '0',
    }
};

export default withStyles(styles)(ContentFilterRow);

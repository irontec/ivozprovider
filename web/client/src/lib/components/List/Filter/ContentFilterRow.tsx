import React, { useState, ChangeEvent } from 'react';
import { TextField, Grid, Menu, MenuItem, IconButton } from '@mui/material';
import Autocomplete from '@mui/material/Autocomplete';
import FilterIconFactory from 'icons/FilterIconFactory';
import { FilterList, Filter } from './ContentFilter';

type ValueType = unknown | Array<unknown>;

type ValueStructureType = {
    type: string,
    value: ValueType
};

interface ContentFilterRowProps {
    values: ValueStructureType,
    key: unknown,
    rowNum: number,
    columnName: string,
    columnLabel: string,
    setFilter: (columnName: string, filterType: string, value: ValueType, label?: string) => void,
    filterTypes: FilterList,
    choices: Array<unknown>,
}

export default function ContentFilterRow(props: ContentFilterRowProps): JSX.Element {

    const {
        columnName,
        columnLabel,
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

    const handleToggle = () => {
        setOpen(!open);
    };

    const handleClose = () => {
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

    const options = [];
    for (const idx in choices) {
        options.push({
            value: idx,
            label: choices[idx]
        });
    }

    return (
        <Grid container={true} spacing={3} alignItems="flex-end" className="grid">
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
                                <FilterIconFactory name={filter.value} className="icon" />
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
                            options={options}
                            defaultValue={[] /*values.value as unknown[] || []*/}
                            getOptionLabel={(option) => (option as Filter).label as string}
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
                                <TextField {...params} name={columnName} label={columnName} fullWidth />
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
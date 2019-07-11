package com.example.misra.myapplication.Adapter;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.misra.myapplication.Model.Pelayan;
import com.example.misra.myapplication.R;

import java.util.List;

public class PelayanAdapter extends  RecyclerView.Adapter<PelayanAdapter.MyViewHolder>  {

private List<Pelayan> pelayanList;

public PelayanAdapter(List<Pelayan> pelayantlList) {
        this.pelayanList = pelayantlList;
        }

@Override
public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
        .inflate(R.layout.pelayan_recycle_view, parent, false);
        return new MyViewHolder(itemView);
        }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        Pelayan pelayan = pelayanList.get(position);
        holder.spesialis.setText(pelayan.getSpesialis());

    }

@Override
public int getItemCount() {
        return pelayanList.size();
        }

public class MyViewHolder extends RecyclerView.ViewHolder {
    public TextView spesialis;

    public MyViewHolder(View view) {
        super(view);
        spesialis =  view.findViewById(R.id.spesialis);

    }
}
}

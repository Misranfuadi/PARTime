package com.example.misra.myapplication.Adapter;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;


import com.example.misra.myapplication.Model.Spesialis;
import com.example.misra.myapplication.R;

import java.util.List;

public class SpesialisAdapter extends  RecyclerView.Adapter<SpesialisAdapter.MyViewHolder>  {

    private List<Spesialis> spesialisList;

    public SpesialisAdapter(List<Spesialis> spesialisList) {
        this.spesialisList = spesialisList;
    }

    @Override
    public SpesialisAdapter.MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.spesialis_recycle_view, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull SpesialisAdapter.MyViewHolder holder, int position) {
        Spesialis spesialis = spesialisList.get(position);
        holder.nama.setText(spesialis.getNama());
        holder.tanggal.setText(spesialis.getTanggal());
        holder.buka.setText(spesialis.getBuka()+"-");
        holder.tutup.setText(spesialis.getTutup());


    }

    @Override
    public int getItemCount() {
        return spesialisList.size();
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView nama,tanggal,buka,tutup;


        public MyViewHolder(View view) {
            super(view);
            nama =  view.findViewById(R.id.namaspes);
            tanggal =  view.findViewById(R.id.tanggal);
            buka =  view.findViewById(R.id.buka);
            tutup =  view.findViewById(R.id.tutup);

        }
    }
}